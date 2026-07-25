<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;

class DiagnoseAdminAccess extends Command {
    /**
     * دستور: php artisan admin:diagnose {mobile_or_id}
     *
     * اطلاعات نقش‌ها و دسترسی یک ادمین خاص رو نشون می‌ده تا مشخص بشه چرا
     * بخشی از منو (مثلاً گزارش بدهکاران و بستانکاران) براش دیده نمی‌شه.
     * می‌تونید آیدی عددی ادمین یا شماره موبایلش رو بدید.
     *
     * @var string
     */
    protected $signature = 'admin:diagnose {identifier : آیدی عددی ادمین یا شماره موبایلش}';

    protected $description = 'نمایش نقش‌ها و وضعیت دسترسی یک ادمین برای عیب‌یابی';

    public function handle() {
        $identifier = $this->argument('identifier');

        $admin = is_numeric($identifier)
            ? Admin::query()->with('roles')->find($identifier)
            : Admin::query()->with('roles')->where('mobile', $identifier)->first();

        if (is_null($admin)) {
            $this->error('ادمینی با این مشخصات پیدا نشد.');
            return self::FAILURE;
        }

        $this->info("ادمین: {$admin->id} - " . trim(($admin->name ?? '') . ' ' . ($admin->family ?? '')));

        if ($admin->roles->isEmpty()) {
            $this->error('این ادمین هیچ نقشی (role) نداره! برای همینه که هیچ منویی نمی‌بینه.');
        } else {
            $this->info('نقش‌های این ادمین:');
            foreach ($admin->roles as $role) {
                $this->line("  - {$role->title} ({$role->persian_title})");
            }
        }

        $isChiefManager = $admin->hasRole('Chief Manager');
        $this->line('');
        $this->info('آیا نقش Chief Manager (مدیر اصلی) داره؟ ' . ($isChiefManager ? 'بله' : 'خیر'));
        $this->info('نتیجه‌ی hasPermissionAsTitle("Access Ledger"): ' . ($admin->hasPermissionAsTitle('Access Ledger') ? 'دسترسی دارد' : 'دسترسی ندارد'));

        return self::SUCCESS;
    }
}
