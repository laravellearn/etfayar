<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * مدیریت سراسری خطاها: به‌جای صفحه‌ی سفید/خام خطای لاراول در محیط عملیاتی،
     * کاربر به صفحه‌ی قبلی برمی‌گرده و پیغام مناسب (فارسی) از طریق همون مکانیزم
     * toast عمومی (session('error')) نمایش داده می‌شه.
     *
     * در حالت debug (محیط توسعه) یا برای درخواست‌های JSON/AJAX دست نمی‌زنیم،
     * تا هم توسعه‌دهنده جزئیات خطا رو ببینه و هم کدهای JS که منتظر پاسخ JSON
     * هستن خراب نشن.
     */
    public function render($request, Throwable $e)
    {
        if (config('app.debug') || $request->expectsJson() || $request->ajax()) {
            return parent::render($request, $e);
        }

        // خطاهای اعتبارسنجی فرم رو دست نمی‌زنیم؛ رفتار پیش‌فرض لاراول
        // (redirect back با $errors) درسته و توسط toast سراسری نمایش داده می‌شه.
        if ($e instanceof ValidationException) {
            return parent::render($request, $e);
        }

        if ($e instanceof AuthorizationException || $e instanceof AccessDeniedHttpException) {
            return back()->with('error', 'شما اجازه‌ی دسترسی به این بخش را ندارید.');
        }

        if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
            return back()->with('error', 'مورد درخواستی یافت نشد.');
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return back()->with('error', 'درخواست نامعتبر است.');
        }

        if ($e instanceof QueryException) {
            return back()->with('error', 'خطایی در ارتباط با پایگاه داده رخ داد. لطفاً دوباره تلاش کنید.');
        }

        // هر خطای پیش‌بینی‌نشده‌ی دیگری (500)
        return back()->with('error', 'خطایی غیرمنتظره رخ داد. لطفاً دوباره تلاش کنید یا با پشتیبانی تماس بگیرید.');
    }
}
