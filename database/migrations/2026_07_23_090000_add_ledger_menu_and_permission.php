<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddLedgerMenuAndPermission extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // 1) مجوز دسترسی به گزارش بدهکاران و بستانکاران
        $permissionId = DB::table('permissions')->where('title', 'Access Ledger')->value('id');
        if (is_null($permissionId)) {
            $maxCode = (int)DB::table('permissions')->max('code');
            $permissionId = DB::table('permissions')->insertGetId([
                'code' => max($maxCode + 1, 5551),
                'title' => 'Access Ledger',
                'persian_title' => 'دسترسی به گزارش بدهکاران و بستانکاران',
                'parent_title' => 'Manage Financial',
                'status' => 1,
            ]);
        }

        // 2) آیتم‌های منو، زیرمجموعه‌ی «امور مالی» (parent_code = 500)
        $menuItems = [
            [
                'title' => 'گزارش بدهکاران و بستانکاران',
                'url' => 'ledger.index',
                'permission_title' => 'Access Ledger',
                'position' => 530,
            ],
            [
                'title' => 'پرداخت‌های در انتظار تایید',
                'url' => 'ledger.pending',
                'permission_title' => 'Access Ledger',
                'position' => 531,
            ],
            [
                'title' => 'پرداخت‌های رد شده',
                'url' => 'ledger.rejected',
                'permission_title' => 'Access Ledger',
                'position' => 532,
            ],
        ];

        // پیدا کردن آیدی واقعیِ آیتم منوی والد («امور مالی») برای nested کردن زیرمنوها
        $financialParentId = DB::table('menus')
            ->where('title', 'امور مالی')
            ->where('type', 'menu')
            ->value('id');

        // ستون‌های واقعیِ جدول menus روی این دیتابیس (چون هیچ migration ای این
        // جدول رو در پروژه نساخته، نمی‌شه ساختارش رو از قبل مطمئن بود؛ برای
        // همین کاملاً پویا فقط همون ستون‌هایی که واقعاً وجود دارن رو پر می‌کنیم).
        $menuColumns = \Illuminate\Support\Facades\Schema::getColumnListing('menus');

        foreach ($menuItems as $item) {
            $exists = DB::table('menus')->where('url', $item['url'])->exists();
            if ($exists) {
                continue;
            }

            $candidate = [
                'title' => $item['title'],
                'icon' => null,
                'type' => 'sub_menu',
                'url' => $item['url'],
                'permission_title' => $item['permission_title'],
                'permission_code' => $item['position'],
                'parent_id' => $financialParentId,
                'parent_code' => 500,
                'position' => $item['position'],
                'status' => 1,
            ];

            $row = array_intersect_key($candidate, array_flip($menuColumns));

            DB::table('menus')->insert($row);
        }

        // 3) اعطای این مجوز به نقش‌های مالی که در گزارش بدهکاران و بستانکاران کار می‌کنن
        $financialRoleIds = DB::table('roles')
            ->whereIn('title', ['financial manager', 'Chief Financial Officer', 'Accountants', 'Accounting assistant'])
            ->pluck('id');

        foreach ($financialRoleIds as $roleId) {
            $alreadyLinked = DB::table('permission_role')
                ->where('role_id', $roleId)
                ->where('permission_id', $permissionId)
                ->exists();
            if (!$alreadyLinked) {
                DB::table('permission_role')->insert([
                    'role_id' => $roleId,
                    'permission_id' => $permissionId,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('menus')->whereIn('url', ['ledger.index', 'ledger.pending', 'ledger.rejected'])->delete();
        $permissionId = DB::table('permissions')->where('title', 'Access Ledger')->value('id');
        if (!is_null($permissionId)) {
            DB::table('permission_role')->where('permission_id', $permissionId)->delete();
            DB::table('permissions')->where('id', $permissionId)->delete();
        }
    }
}
