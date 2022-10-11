<?php

namespace App\Http\Services\Payment;

use App\Models\Market\OnlinePayment;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Config;
use Zarinpal\Clients\GuzzleClient;
use Zarinpal\Zarinpal;

class PaymentService
{
    /**
     * |
     * | The Service is based on zarinpal documentation.
     * | https://docs.zarinpal.com/paymentGateway/guide/#%D8%A7%D9%86%D8%AA%D9%82%D8%A7%D9%84-%DA%A9%D8%A7%D8%B1%D8%A8%D8%B1-%D8%A8%D9%87-%D8%B5%D9%81%D8%AD%D9%87-%D9%BE%D8%B1%D8%AF%D8%A7%D8%AE%D8%AA
     * |
     */

    public function zarinpalVerify($amount, $onlinePayment) {
        $authority = $_GET['Authority'];
        $data = [
            'merchant_id' => Config::get('payment.zarinpal_api_key'),
            'authority' => $authority,
            'amount' => (int)$amount,
        ];

        // cast data to json
        $jsonData = json_encode($data);

        // Zarinpal necessary data to verify
        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');

        // zarinpal sandbox
        // $ch = curl_init('https://sandbox.zarinpal.com/pg/v4/payment/verify.json');
        // end zarinpal sandbox

        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        // cast json result to array bank_second_response
        $result = json_decode($result, true);

        // update online payment
        $onlinePayment->update([
            'bank_second_response' => $result
        ]);


        // Error management
        if (count($result['errors']) == 0)
            // check if payment succeeded
            if ($result['data']['code'] == 100)
                return ['success' => true];
            // check if payment succeeded but in continue there is an error
            else return ['success' => false];
        // if there is an error
        else return ['success' => false];
    }


    public function zarinpal($amount, $order, $onlinePayment) {

        $merchantID = Config::get('payment.zarinpal_api_key');

        $sandbox = false;
        $zarinpalGate = false;
        $client = new GuzzleClient($sandbox);
        $zarinpalGatePSP = '';
        $lang = 'fa';

        $zarinpal = new Zarinpal($merchantID, $client, $lang, $sandbox, $zarinpalGate, $zarinpalGatePSP);

        $payment = [
            'callback_url' => route('customer.sales-process.payment-callback', [$order, $onlinePayment]),
            'amount' => (int)$amount * 10,
            'description' => 'Order',
        ];

        try {

            $response = $zarinpal->request($payment);

            $code = $response['data']['code'];
            $message = $zarinpal->getCodeMessage($code);

            if ($code == 100) :
                $onlinePayment->update([
                    'bank_first_response' => $response
                ]);
                $authority = $response['date']['authority'];
                return $zarinpal->redirect($authority);
            endif;
        } catch (RequestException $exception) {

            return false;
        }
    }

    /**
     * @param $code
     * @return string
     */
    function resultCodes($code) {
        switch ($code) {
            case 100:
                return "با موفقیت تایید شد";

            case 102:
                return "merchant یافت نشد";

            case 103:
                return "merchant غیرفعال";

            case 104:
                return "merchant نامعتبر";

            case 201:
                return "قبلا تایید شده";

            case 105:
                return "amount بایستی بزرگتر از 1,000 ریال باشد";

            case 106:
                return "callbackUrl نامعتبر می‌باشد. (شروع با http و یا https)";

            case 113:
                return "amount مبلغ تراکنش از سقف میزان تراکنش بیشتر است.";

            case 201:
                return "قبلا تایید شده";

            case 202:
                return "سفارش پرداخت نشده یا ناموفق بوده است";

            case 203:
                return "trackId نامعتبر می‌باشد";

            default:
                return "وضعیت مشخص شده معتبر نیست";
        }
    }

    /**
     * returns a string message based on status parameter from $_GET
     * @param $code
     * @return String
     */
    function statusCodes($code) {
        switch ($code) {
            case -1:
                return "در انتظار پردخت";

            case -2:
                return "خطای داخلی";

            case 1:
                return "پرداخت شده - تاییدشده";

            case 2:
                return "پرداخت شده - تاییدنشده";

            case 3:
                return "لغوشده توسط کاربر";

            case 4:
                return "‌شماره کارت نامعتبر می‌باشد";

            case 5:
                return "‌موجودی حساب کافی نمی‌باشد";

            case 6:
                return "رمز واردشده اشتباه می‌باشد";

            case 7:
                return "‌تعداد درخواست‌ها بیش از حد مجاز می‌باشد";

            case 8:
                return "‌تعداد پرداخت اینترنتی روزانه بیش از حد مجاز می‌باشد";

            case 9:
                return "مبلغ پرداخت اینترنتی روزانه بیش از حد مجاز می‌باشد";

            case 10:
                return "‌صادرکننده‌ی کارت نامعتبر می‌باشد";

            case 11:
                return "خطای سوییچ";

            case 12:
                return "کارت قابل دسترسی نمی‌باشد";

            default:
                return "وضعیت مشخص شده معتبر نیست";
        }
    }

}