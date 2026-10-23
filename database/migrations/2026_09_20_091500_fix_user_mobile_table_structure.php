<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixUserMobileTableStructure extends Migration {
    /**
     * Run the migrations.
     *
     * این مایگریشن دو مشکل ریشه‌ای رو در جدول user_mobile (شماره‌های اضافی
     * مشتری) درست می‌کنه که باعث می‌شد «شماره ثابتِ به‌تنهایی» ذخیره نشه:
     *
     * ۱) روی دیتابیس واقعی، ستون telephone اصلاً روی این جدول وجود نداره
     *    (با اینکه کنترلر/مدل بهش مقدار می‌دن) - این مایگریشن فقط در صورت
     *    نبودنش اضافه‌ش می‌کنه.
     *
     * ۲) کلید اصلی جدول ترکیبیه: (user_id, mobile). چون mobile بخشی از
     *    کلید اصلیه، دیتابیس اجازه‌ی NULL روش نمی‌ده و اگه به‌جاش مقدار
     *    خالی ('') ذخیره بشه، برای دومین «شماره ثابت به‌تنهایی» همون
     *    کاربر، کلید تکراری می‌شه و ذخیره با خطا مواجه میشه. این مایگریشن
     *    کلید اصلی رو به یک ستون id خودکار (auto-increment) عادی تغییر
     *    می‌ده و ستون mobile رو nullable می‌کنه؛ در نتیجه می‌شه چند بار
     *    فقط «تلفن ثابت» بدون موبایل برای یک مشتری ثبت کرد.
     *
     * این مایگریشن idempotent نوشته شده (چک می‌کنه ستون/تغییر از قبل
     * انجام نشده باشه) تا اجرای دوباره‌ش خطا نده.
     *
     * ⚠️ پیشنهاد می‌شه قبل از اجرای این مایگریشن روی دیتابیس واقعی، از
     * جدول user_mobile (یا کل دیتابیس) بک‌آپ گرفته بشه، چون ساختار کلید
     * اصلی جدول تغییر می‌کنه.
     *
     * @return void
     */
    public function up() {
        // ۱) افزودن ستون telephone در صورت نبودن
        if (!Schema::hasColumn('user_mobile', 'telephone')) {
            Schema::table('user_mobile', function (Blueprint $table) {
                $table->string('telephone', 20)->nullable()->after('mobile');
            });
        }

        // اگر قبلاً این مایگریشن اجرا شده و ستون id ساخته شده، دوباره کاری لازم نیست
        if (Schema::hasColumn('user_mobile', 'id')) {
            return;
        }

        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            // کلید اصلی ترکیبی قبلی رو برمی‌داریم و یک ستون id خودکار
            // به‌عنوان کلید اصلی جدید اضافه می‌کنیم؛ mobile هم nullable می‌شه.
            DB::statement('ALTER TABLE `user_mobile` DROP PRIMARY KEY');
            DB::statement('ALTER TABLE `user_mobile` ADD COLUMN `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY FIRST');
            DB::statement('ALTER TABLE `user_mobile` MODIFY `mobile` VARCHAR(11) NULL');
        } else {
            // SQLite کلید اصلی رو نمی‌شه مستقیم تغییر داد؛ جدول رو با
            // ساختار درست از نو می‌سازیم و داده‌های قبلی رو منتقل می‌کنیم.
            Schema::create('user_mobile_new', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('mobile', 11)->nullable();
                $table->string('telephone', 20)->nullable();
                $table->string('mobile_owner', 100)->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });

            DB::statement('INSERT INTO user_mobile_new (user_id, mobile, telephone, mobile_owner) SELECT user_id, mobile, telephone, mobile_owner FROM user_mobile');

            Schema::drop('user_mobile');
            Schema::rename('user_mobile_new', 'user_mobile');
        }
    }

    /**
     * Reverse the migrations.
     *
     * برگردوندن دقیقِ کلید اصلی ترکیبی، اگه در این فاصله ردیفی با mobile
     * خالی/تکراری برای یک کاربر ثبت شده باشه امکان‌پذیر نیست؛ برای همین
     * این متد عمداً فقط ستون id رو حذف می‌کنه و ساختار امن فعلی رو حفظ
     * می‌کنه.
     *
     * @return void
     */
    public function down() {
        if (Schema::hasColumn('user_mobile', 'id') && DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE `user_mobile` DROP PRIMARY KEY, DROP COLUMN `id`');
        }
    }
}
