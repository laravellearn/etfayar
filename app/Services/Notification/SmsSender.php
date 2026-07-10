<?php

namespace App\Services\Notification;

use App\Models\MessageReport;
use App\Models\Setting;
use App\Models\UserSupport;
use Exception;
use Illuminate\Support\Facades\Log;
use Melipayamak;

class SmsSender {


    public static function user_registered($user) {
        if (!is_null($user->mobile)) {
            $text = Setting::getValue('save_user_text');
            $pattern = "/{(full_name)}/m";
            $userArray = array($user)[0];
            $text = preg_replace_callback($pattern, function ($m) use ($userArray) {
                return $userArray[$m[1]];
            }, $text);

            $customer_code_pattern = "/{(customer_code)}/m";
            $text = preg_replace_callback($customer_code_pattern, function ($m) use ($userArray) {
                return $userArray[$m[1]];
            }, $text);
            self::send($text, $user->mobile, 'user_registered', $user);

        }
    }

    public static function request_registered($request) {
        $user = $request->user;
        if (!is_null($user->mobile)) {
            $text = Setting::getValue('save_request_text');

            $pattern = "/{(full_name)}/m";
            $userArray = array($user)[0];
            $text = preg_replace_callback($pattern, function ($m) use ($userArray) {
                return $userArray[$m[1]];
            }, $text);


            $status_pattern = "/{(statusValue)}/m";
            $requestArray = array($request)[0];
            $text = preg_replace_callback($status_pattern, function ($m) use ($requestArray) {
                return $requestArray[$m[1]]->title;
            }, $text);


            $title_pattern = "/{(title)}/m";
            $text = preg_replace_callback($title_pattern, function ($m) use ($requestArray) {
                return $requestArray->service[$m[1]];
            }, $text);

            self::send($text, $user->mobile, 'request_registered', $user);
        }
    }

    public static function invoice_registered($invoice) {
        $user = $invoice->request->user;
        if (!is_null($user->mobile)) {
            $text = Setting::getValue('save_invoice_text');

            $pattern = "/{(full_name)}/m";
            $userArray = array($user)[0];
            $text = preg_replace_callback($pattern, function ($m) use ($userArray) {
                return $userArray[$m[1]];
            }, $text);

            $code_pattern = "/{(code)}/m";
            $invoiceArray = array($invoice)[0];
            $text = preg_replace_callback($code_pattern, function ($m) use ($invoiceArray) {
                return $invoiceArray[$m[1]];
            }, $text);

            self::send($text, $user->mobile, 'invoice_registered', $user);
        }

    }

    public static function support_registered($userSupport) {
        $user = $userSupport->user;
        Log::info("user mobile:" . $user->mobile);
        if (!is_null($user->mobile)) {
            $text = Setting::getValue('save_support_text');

            $pattern = "/{(full_name)}/m";
            $userArray = array($user)[0];
            $text = preg_replace_callback($pattern, function ($m) use ($userArray) {
                return $userArray[$m[1]];
            }, $text);


            $code_pattern = "/{(date)}/m";
            $dateArray = array($userSupport)[0];
            $text = preg_replace_callback($code_pattern, function ($m) use ($dateArray) {
                return $dateArray['persianSupportTime'];
            }, $text);
            Log::info("date text:" . $text);
            self::send($text, $user->mobile, 'support_registered', $user, $userSupport->id);
        }

    }


    public static function send(string $text, string $to, $type, $user = null, $user_support_id = null) {
        try {

            $sms = Melipayamak::sms();
            //$from = '50004000139251';
            $from = Setting::getValue('melipayamak_sms_number');
            $response = $sms->send($to, $from, $text);
            //$response = $sms->send('09387210537', $from, $text);
            $json = json_decode($response);
            Log::info("sms text:" . $text);
            Log::info("sms response:" . $response);
            Log::info("json->Value:" . $json->Value);
            //echo $json->Value; //RecId or Error Number

            $admin_id = $user->expert_id;
            if ($type != 'support_registered') {
                $admin_id = auth('admin')->id();
            }

            if ($type == 'support_registered') {
                $single = UserSupport::query()->where('id', $user_support_id)->first();
                $single->done_time = now()->toDateTimeString();
                $single->save();
            }

            MessageReport::save_report($admin_id, $user->id, $to, $text, $type, $response);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


}
