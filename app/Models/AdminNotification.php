<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model {

    public static function getRead($notification_id, $admin_id) {
        $single = AdminNotification::query()
            ->where('admin_id', $admin_id)
            ->where('notification_id', $notification_id)
            ->first();
        return $single;

    }

}
