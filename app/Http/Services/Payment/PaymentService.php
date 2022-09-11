<?php

namespace App\Http\Services\Payment;

use App\Models\Market\OnlinePayment;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Config;
use Zarinpal\Clients\GuzzleClient;
use Zarinpal\Zarinpal;

class PaymentService
{
    public function zarinpal() {
        $amount = 0;
        $merchantID = Config::get('payment.zarinpal_api_key');
        $sandbox = false;
        $zarinpalGate = false;
        $client = new GuzzleClient($sandbox);
        $zarinpalGatePSP = '';
        $lang = 'fa';
        $zarinpal = new Zarinpal($merchantID, $client, $lang, $sandbox, $zarinpalGate, $zarinpalGatePSP);
        $payment = [
            'callback_url' => route('payment-call-back'),
            'amount' => $amount,
            'description' => 'Order',
        ];

        try {
            $response = $zarinpal->request($payment);
            $onlinePayment = OnlinePayment::first();
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
}