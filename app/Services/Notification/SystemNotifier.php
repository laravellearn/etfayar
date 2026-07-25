<?php

namespace App\Services\Notification;

use App\Models\Notification;
use App\Models\Role;
use Nette\Utils\Json;

/**
 * ابزار مرکزی برای ایجاد خودکار نوتیفیکیشن‌های سیستمی (نه نوتیفیکیشن‌هایی که
 * ادمین دستی از بخش «اطلاعیه‌ها» می‌سازه). از همون جدول/مدل Notification
 * موجود استفاده می‌کنه تا هم در بج بالای هدر و هم در لیست «نوتیفیکیشن‌های
 * دریافتی» نمایش داده بشه.
 */
class SystemNotifier {

    /**
     * ارسال نوتیفیکیشن به یک ادمین مشخص (مثلاً کارشناسِ همین درخواست، یا
     * راننده‌ای که همین الان کاری بهش محول شده).
     */
    public static function toAdmin($adminId, string $title, string $body = '', ?string $url = null): ?Notification {
        if (is_null($adminId)) {
            return null;
        }

        $notification = new Notification();
        $notification->title = $title;
        $notification->body = $body;
        $notification->url = $url;
        $notification->admin_id = $adminId;
        $notification->status = 1;
        $notification->save();

        return $notification;
    }

    /**
     * ارسال نوتیفیکیشن به همه‌ی ادمین‌هایی که یکی از این نقش‌ها رو دارن
     * (مثلاً همه‌ی «سرپرست ترابری»ها یا «مدیر مالی»ها).
     */
    public static function toRoles(array $roleTitles, string $title, string $body = '', ?string $url = null): ?Notification {
        $roleIds = Role::query()
            ->whereIn('title', $roleTitles)
            ->pluck('id')
            ->map(fn($id) => (string)$id)
            ->all();

        if (empty($roleIds)) {
            return null;
        }

        $notification = new Notification();
        $notification->title = $title;
        $notification->body = $body;
        $notification->url = $url;
        $notification->roles = Json::encode($roleIds);
        $notification->status = 1;
        $notification->save();

        return $notification;
    }
}
