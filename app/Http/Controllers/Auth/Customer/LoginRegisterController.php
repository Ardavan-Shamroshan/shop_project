<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\SmsService;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\Auth\Customer\LoginRegisterRequest;

class LoginRegisterController extends Controller
{
    public function loginRegisterForm()
    {
        return view('customer.auth.login-register-form');
    }

    /**
     * @throws \Exception
     */

    public function loginRegister(LoginRegisterRequest $request)
    {
        $inputs = $request->all();

        // check id is email or not
        if (filter_var($inputs['id'], FILTER_VALIDATE_EMAIL)) {
            $type = 1; // 1 => email
            $user = User::query()->where('email', $inputs['id'])->first();
            if (empty($user)) {
                $newUser['email'] = $inputs['id'];
            }
        } //check id is mobile or not
        elseif (preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['id'])) {
            $type = 0; // 0 => mobile;

            // all mobile numbers are in format 9** *** ***
            $inputs['id'] = ltrim($inputs['id'], '0');
            //            $inputs['id'] = substr($inputs['id'], 0, 2) === '98' ? substr($inputs['id'], 2) : $inputs['id'];
            $inputs['id'] = str_starts_with($inputs['id'], '98') ? substr($inputs['id'], 2) : $inputs['id'];
            $inputs['id'] = str_replace('+98', '', $inputs['id']);

            $user = User::query()->where('mobile', $inputs['id'])->first();
            if (empty($user)) {
                $newUser['mobile'] = $inputs['id'];
            }
        } else {
            $errorText = 'شناسه ورودی شما نه شماره موبایل است نه ایمیل';
            return redirect()->route('auth.customer.loginRegisterForm')->withErrors(['id' => $errorText]);
        }

        if (empty($user)) {
            $newUser['password'] = '14201420Aa!';
            $newUser['activation'] = 1;
            $user = User::query()->create($newUser);
        }

        //create otp code
        $otpCode = random_int(111111, 999999);
        $token = Str::random(60);
        $otpInputs = [
            'token' => $token,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'login_id' => $inputs['id'],
            'type' => $type,
        ];

        Otp::query()->create($otpInputs);

        //send sms or email

        if ($type == 0) {
            //send sms
            $smsService = new SmsService();
            $smsService->setFrom(Config::get('sms.otp_from'));
            $smsService->setTo(['0' . $user->mobile]);
            $smsService->setText("مجموعه آمازون \n  کد تایید : $otpCode");
            $smsService->setIsFlash(true);
            $messagesService = new MessageService($smsService);
        } elseif ($type === 1) {
            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فعال سازی',
                'body' => "کد فعال سازی شما : $otpCode"
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('noreply@example.com', 'example');
            $emailService->setSubject('کد احراز هویت');
            $emailService->setTo($inputs['id']);

            $messagesService = new MessageService($emailService);
        }
        $messagesService->send();

        return redirect()->route('auth.customer.loginConfirmForm', $token);
    }


    public function loginConfirmForm($token)
    {
        $otp = Otp::query()->where('token', $token)->first();
        if (empty($otp))
            return redirect()->route('auth.customer.loginRegisterForm')->withErrors([
                'id' => 'آدرس وارد شده نا معتبر می باشد',
            ]);

        return view('customer.auth.login-confirm-form', compact('token', 'otp'));
    }

    public function loginConfirm($token, LoginRegisterRequest $request)
    {
        $inputs = $request->all();
        $otp = Otp::query()->where('token', $token)->where('used', 0)->where('created_at', '>=', Carbon::now()->subMinute(5)->toDateTimeString())->first();
        if (empty($otp))
            return redirect()->route('auth.customer.loginRegisterForm', $token)->withErrors([
                'id' => 'آدرس وارد شده نا معتبر می باشد',
            ]);

        // if otp not match
        if ($otp->otp_code !== $inputs['otp']) {
                return redirect()->route('auth.customer.loginConfirmForm', $token)->withErrors([
                    'otp' => 'کد وارد شده صحیح نمی باشد',
                ]);
        }

        // if everything is ok
        $otp->update(['used' => 1]);
        $user = $otp->user()->first();
        if ($otp->type == 0 && empty($user->mobile_verified_at))
            $user->update(['mobile_verified_at' => Carbon::now()]);
        elseif ($otp->type == 1 && empty($user->email_verified_at))
            $user->update(['email_verified_at' => Carbon::now()]);

        Auth::login($user);
        return redirect()->route('customer.home');
    }

    /**
     * @throws \Exception
     */
    public function loginResendOtp($token)
    {
        $otp = Otp::query()->where('token', $token)->where('created_at', '<=', Carbon::now()->subMinutes(5)->toDateTimeString())->first();
        if (empty($otp))
            return redirect()->route('auth.customer.loginRegisterForm', $token)->withErrors(['id' => 'آدرس وارد شده نام معتبر است']);


        $user = $otp->user()->first();
        //create otp code
        $otpCode = random_int(111111, 999999);
        $token = Str::random(60);
        $otpInputs = [
            'token' => $token,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'login_id' => $otp->login_id,
            'type' => $otp->type,
        ];

        Otp::query()->create($otpInputs);

        //send sms or email

        if ($otp->type == 0) {
            //send sms
            $smsService = new SmsService();
            $smsService->setFrom(Config::get('sms.otp_from'));
            $smsService->setTo(['0' . $user->mobile]);
            $smsService->setText("مجموعه آمازون \n  کد تایید : $otpCode");
            $smsService->setIsFlash(true);
            $messagesService = new MessageService($smsService);
        } elseif ($otp->type === 1) {
            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فعال سازی',
                'body' => "کد فعال سازی شما : $otpCode"
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('noreply@example.com', 'example');
            $emailService->setSubject('کد احراز هویت');
            $emailService->setTo($otp->login_id);

            $messagesService = new MessageService($emailService);
        }
        $messagesService->send();

        return redirect()->route('auth.customer.loginConfirmForm', $token);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('customer.home');
    }
}
