<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddReportsMenuAndPermission extends Migration {
    /**
     * دستور: php artisan migrate
     *
     * این migration دقیقاً از همون الگوی migration قبلی «افزودن منو و مجوز
     * گزارش بدهکاران و بستانکاران» (2026_07_23_090000) پیروی می‌کنه.
     *
     * @return void
     */
    public function up() {
        // ۱) مجوز دسترسی به داشبورد گزارشات (یک مجوز مشترک برای منوی اصلی و
        // تمام زیرمنوها، دقیقاً مثل الگوی «Access Ledger»)
        $permissionId = DB::table('permissions')->where('title', 'Access Reports')->value('id');
        if (is_null($permissionId)) {
            $maxCode = (int)DB::table('permissions')->max('code');
            $permissionId = DB::table('permissions')->insertGetId([
                'code' => max($maxCode + 1, 5601),
                'title' => 'Access Reports',
                'persian_title' => 'دسترسی به داشبورد گزارشات',
                'parent_title' => 'Manage Reports',
                'status' => 1,
            ]);
        }

        $menuColumns = Schema::getColumnListing('menus');

        // ۲) دیوایدر + منوی اصلیِ «داشبورد گزارشات» در بالای سایدبار (position
        // کوچیک انتخاب شده تا بالای بقیه‌ی منوها قرار بگیره)
        $dividerExists = DB::table('menus')->where('title', 'گزارشات')->where('type', 'divider')->exists();
        if (!$dividerExists) {
            $dividerCandidate = [
                'title' => 'گزارشات',
                'icon' => null,
                'type' => 'divider',
                'url' => null,
                'permission_title' => 'Access Reports',
                'permission_code' => 50,
                'parent_id' => null,
                'parent_code' => null,
                'position' => 50,
                'status' => 1,
            ];
            DB::table('menus')->insert(array_intersect_key($dividerCandidate, array_flip($menuColumns)));
        }

        $parentMenuId = DB::table('menus')->where('title', 'داشبورد گزارشات')->where('type', 'menu')->value('id');
        if (is_null($parentMenuId)) {
            // آیکون نمودار (Bar Chart) از همون ست آیکون‌های SVG استفاده‌شده در بقیه‌ی منوها
            $chartIcon = '<span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect><rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect><rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect><rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect></g></svg></span>';

            $parentCandidate = [
                'title' => 'داشبورد گزارشات',
                'icon' => $chartIcon,
                'type' => 'menu',
                'url' => null,
                'permission_title' => 'Access Reports',
                'permission_code' => 51,
                'parent_id' => null,
                'parent_code' => null,
                'position' => 51,
                'status' => 1,
            ];
            $parentMenuId = DB::table('menus')->insertGetId(array_intersect_key($parentCandidate, array_flip($menuColumns)));
        }

        // ۳) زیرمنوها
        $subMenus = [
            ['title' => 'مشتریان و درخواست‌ها', 'url' => 'reports.customers_requests', 'position' => 52],
            ['title' => 'پیش‌فاکتور، فاکتور و درآمد', 'url' => 'reports.invoices_revenue', 'position' => 53],
            ['title' => 'ترابری و کارگاه', 'url' => 'reports.transport_workshop', 'position' => 54],
            ['title' => 'سرویس‌ها و حساب‌ها', 'url' => 'reports.services_accounts', 'position' => 55],
        ];

        foreach ($subMenus as $item) {
            $exists = DB::table('menus')->where('url', $item['url'])->exists();
            if ($exists) {
                continue;
            }
            $candidate = [
                'title' => $item['title'],
                'icon' => null,
                'type' => 'sub_menu',
                'url' => $item['url'],
                'permission_title' => 'Access Reports',
                'permission_code' => $item['position'],
                'parent_id' => $parentMenuId,
                'parent_code' => null,
                'position' => $item['position'],
                'status' => 1,
            ];
            DB::table('menus')->insert(array_intersect_key($candidate, array_flip($menuColumns)));
        }

        // ۴) اعطای مجوز به نقش‌های مدیریتی (کسانی که معمولاً باید گزارشات کلی رو ببینن)
        $managementRoleIds = DB::table('roles')
            ->whereIn('title', ['Chief Manager', 'General Manager', 'CEO'])
            ->pluck('id');

        foreach ($managementRoleIds as $roleId) {
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
     * @return void
     */
    public function down() {
        DB::table('menus')->whereIn('url', [
            'reports.customers_requests',
            'reports.invoices_revenue',
            'reports.transport_workshop',
            'reports.services_accounts',
        ])->delete();
        DB::table('menus')->where('title', 'داشبورد گزارشات')->where('type', 'menu')->delete();
        DB::table('menus')->where('title', 'گزارشات')->where('type', 'divider')->delete();

        $permissionId = DB::table('permissions')->where('title', 'Access Reports')->value('id');
        if (!is_null($permissionId)) {
            DB::table('permission_role')->where('permission_id', $permissionId)->delete();
            DB::table('permissions')->where('id', $permissionId)->delete();
        }
    }
}
