<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;

class AssignAllPermissionsToChiefManager extends Command {
    /**
     * دستور: php artisan roles:assign-all-to-chief-manager
     *
     * تمام مجوزهای موجود در جدول permissions رو به نقش «مدیر اصلی»
     * (Chief Manager) اختصاص می‌ده. توجه: در کد، مدیر اصلی از قبل به همه‌چیز
     * دسترسی داره (صرف‌نظر از این‌که مجوزها بهش assign شده باشن یا نه) — این
     * دستور فقط برای این هست که در صفحه‌ی مدیریت نقش‌ها/مجوزها هم به‌صورت
     * واقعی و قابل‌مشاهده، همه‌ی مجوزها تیک‌خورده نشون داده بشن.
     *
     * @var string
     */
    protected $signature = 'roles:assign-all-to-chief-manager';

    protected $description = 'اختصاص تمام مجوزهای موجود به نقش مدیر اصلی (Chief Manager)';

    public function handle() {
        $role = Role::query()->where('title', 'Chief Manager')->first();

        if (is_null($role)) {
            $this->error('نقش «Chief Manager» (مدیر اصلی) پیدا نشد.');
            return self::FAILURE;
        }

        $allPermissionIds = Permission::query()->pluck('id');

        if ($allPermissionIds->isEmpty()) {
            $this->warn('هیچ مجوزی در جدول permissions وجود ندارد.');
            return self::SUCCESS;
        }

        // syncWithoutDetaching: مجوزهای قبلی این نقش دست‌نخورده می‌مونن، فقط
        // مجوزهای جدید (اگه از قبل نداشته) بهش اضافه می‌شه.
        $role->permissions()->syncWithoutDetaching($allPermissionIds);

        $this->info("تمام {$allPermissionIds->count()} مجوز به نقش «مدیر اصلی» اختصاص داده شد.");

        return self::SUCCESS;
    }
}
