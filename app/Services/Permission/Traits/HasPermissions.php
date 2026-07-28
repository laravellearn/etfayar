<?php

namespace App\Services\Permission\Traits;

use App\Models\Permission;

/**
 * این trait روی هر دو مدل Admin و Role استفاده می‌شه.
 *
 * جدول pivot برای هر مدل:
 *   - Admin  → admin_permission  (admin_id, permission_id)
 *   - Role   → permission_role   (role_id,  permission_id)
 *
 * متد permissions() اینجا با pivot صریح تعریف شده و به‌صورت dynamic
 * بر اساس نام مدل، جدول و کلید خارجی درست رو انتخاب می‌کنه.
 *
 * تغییرات این نسخه نسبت به نسخه‌ی اصلی:
 *   1. متد permissions() با pivot صریح و dynamic — برای هر دو Admin و Role کار می‌کنه
 *   2. اضافه کردن whereNull('deleted_at') در getAllPermissions برای رعایت soft-delete
 *   3. اضافه کردن hasPermissionById برای چک سریع‌تر بر اساس آیدی
 */
trait HasPermissions
{
    /**
     * رابطه‌ی permissions با pivot صریح.
     *
     * برای Admin  : pivot = admin_permission,  foreign = admin_id
     * برای Role   : pivot = permission_role,   foreign = role_id
     */
    public function permissions()
    {
        // نام کلاس فعلی (بدون namespace) را به حروف کوچک تبدیل می‌کنیم
        // تا نام pivot و foreign key را به‌صورت dynamic بسازیم.
        $modelName = strtolower(class_basename(static::class)); // 'admin' یا 'role'

        if ($modelName === 'role') {
            return $this->belongsToMany(
                Permission::class,
                'permission_role',  // جدول pivot
                'role_id',          // کلید خارجی این مدل
                'permission_id'     // کلید خارجی Permission
            );
        }

        // پیش‌فرض: Admin (و هر مدل دیگری که این trait را use کرده)
        return $this->belongsToMany(
            Permission::class,
            'admin_permission',  // جدول pivot
            'admin_id',          // کلید خارجی این مدل
            'permission_id'      // کلید خارجی Permission
        );
    }

    /**
     * اعطای یک یا چند مجوز (بر اساس title) بدون حذف مجوزهای قبلی
     */
    public function givePermissionsTo(...$permissions): static
    {
        $permissions = $this->getAllPermissions($permissions);

        if ($permissions->isEmpty()) {
            return $this;
        }

        $this->permissions()->syncWithoutDetaching($permissions);

        return $this;
    }

    /**
     * پیدا کردن Permission های معتبر (غیر soft-deleted) بر اساس title
     */
    private function getAllPermissions(array $permissions)
    {
        return Permission::query()
            ->whereNull('deleted_at')
            ->whereIn('title', collect($permissions)->flatten())
            ->get();
    }

    /**
     * حذف یک یا چند مجوز از این نقش/ادمین
     */
    public function withdrawPermission(...$permissions): static
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);

        return $this;
    }

    /**
     * جایگزین کردن کامل لیست مجوزها (sync)
     */
    public function refreshPermissions(...$permissions): static
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->sync($permissions);

        return $this;
    }

    /**
     * بررسی دسترسی به یک Permission خاص.
     * مدیر اصلی (Chief Manager) همیشه true برمی‌گردونه.
     */
    public function hasPermission(Permission $permission): bool
    {
        // مدیر اصلی به همه‌ی مجوزها دسترسی داره بدون نیاز به تخصیص تک‌تک
        if ($this->hasRole('Chief Manager')) {
            return true;
        }

        return $this->hasPermissionThroughRole($permission)
            || $this->permissions->contains($permission);
    }

    /**
     * بررسی دسترسی بر اساس عنوان (title) مجوز
     */
    public function hasPermissionAsTitle(string $permissionTitle): bool
    {
        if ($this->hasRole('Chief Manager')) {
            return true;
        }

        $permission = Permission::query()
            ->whereNull('deleted_at')
            ->where('title', $permissionTitle)
            ->first();

        if (is_null($permission)) {
            return false;
        }

        return $this->hasPermission($permission);
    }

    /**
     * بررسی دسترسی بر اساس آیدی مجوز (سریع‌تر از title)
     */
    public function hasPermissionById(int $permissionId): bool
    {
        if ($this->hasRole('Chief Manager')) {
            return true;
        }

        $permission = Permission::query()
            ->whereNull('deleted_at')
            ->find($permissionId);

        if (is_null($permission)) {
            return false;
        }

        return $this->hasPermission($permission);
    }

    /**
     * بررسی دسترسی از طریق نقش‌های assign شده
     */
    private function hasPermissionThroughRole(Permission $permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }

        return false;
    }
}
