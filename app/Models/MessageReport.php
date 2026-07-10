<?php

namespace App\Models;

use App\Services\Calendar\PersianDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageReport extends Model {
    use SoftDeletes;
    use PersianDate;


    public function user() {
        return $this->belongsTo(User::class);
    }


    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }


    public static function save_report($admin_id, $user_id, $receiver_mobile, $text, $type, $response) {

        $message_report = new MessageReport();
        $message_report->admin_id = $admin_id;
        $message_report->user_id = $user_id;
        $message_report->receiver_mobile = $receiver_mobile;
        $message_report->text = $text;
        $message_report->type = $type;
        $message_report->response = $response;
        $message_report->save();

    }

    public function getTypeValueAttribute() {
        $status = new \stdClass();
        if ($this->type == 'user_registered') {
            $status->title = 'ثبت مشتری';
            $status->class = 'label label-md font-weight-bold label-success label-inline';
        } else if ($this->type == 'request_registered') {
            $status->title = 'ثبت درخواست';
            $status->class = 'label label-md font-weight-bold label-warning label-inline';
        } else if ($this->type == 'invoice_registered') {
            $status->title = 'ثبت فاکتور';
            $status->class = 'label label-md font-weight-bold label-info label-inline';
        } else if ($this->type == 'custom_message') {
            $status->title = 'پیام شخصی سازی شده';
            $status->class = 'label label-md font-weight-bold label-primary label-inline';
        }else if ($this->type == 'support_registered') {
            $status->title = 'پیام اتوماتیک پشتیبانی';
            $status->class = 'label label-md font-weight-bold label-light-danger label-inline';
        } else {
            $status->title = 'تعیین نشده';
            $status->class = 'label label-md font-weight-bold label-dark-secondary label-inline';
        }
        return $status;
    }


}
