<?php

use App\Http\Controllers\AcquaintanceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CustomInvoiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\FireExtinguisherPartController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\IPsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessageReportController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfficeFormsController;
use App\Http\Controllers\OfficeRequestsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PreinvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TransporterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\UserSupportController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    // dd(auth()->user()->can('add users'));
    // Role::find(1)->givePermissionsTo(['add users','delete posts']);


    //auth()->user()->givePermissionsTo(['add users','delete posts']);
    //auth()->user()->giveRolesTo(['Chief Manager','General Manager']);
    //auth()->user()->refreshRole(['Chief Manager','General Manager']);
    //auth()->user()->withdrawRoles(['General Manager']);
    //auth()->user()->withdrawPermission(['delete posts']);
    //dd(auth()->user()->hasPermission('add users'));
    //dd(auth()->user()->hasRole('Chief Manager'));
    // dd(auth()->user()->can('add users'));
    return view('page.welcome');
});

//->middleware(['can:show panel'])
//->middleware('role:Access Admin Panel')
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('ip.protection');
    Route::post('/submit', [AuthController::class, 'submit'])->name('submit')->middleware('ip.protection');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission:Access Dashboard');
    Route::get('/test', [DashboardController::class, 'test'])->name('test')->middleware('permission:Access Dashboard');
    Route::get('/dashboard/requests', [DashboardController::class, 'requests'])->name('dashboard.requests')->middleware('permission:Access Dashboard');

    Route::get('/admins', [AdminController::class, 'index'])->name('admins')->middleware('permission:Access Admins');
    Route::get('/admin/add', [AdminController::class, 'create'])->name('admin.add')->middleware('permission:Add Admin');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store')->middleware('permission:Add Admin');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit')->middleware('permission:Edit Admin');
    Route::get('/admin/show/{id}', [AdminController::class, 'show'])->name('admin.show')->middleware('permission:Edit Admin');
    Route::post('/admin/update', [AdminController::class, 'update'])->name('admin.update')->middleware('permission:Edit Admin');
    Route::get('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete')->middleware('permission:Delete Admin');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile')->middleware('permission:Access Admin Profile');
    Route::post('/admin/change_password', [AdminController::class, 'change_password'])->name('admin.change_password')->middleware('permission:Access Admin Profile');
    Route::post('/admin/reset_password', [AdminController::class, 'reset_password'])->name('admin.reset_password')->middleware('permission:Access Admin Profile');

    Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('permission:Access Users');
    Route::get('/user/add', [UserController::class, 'create'])->name('user.add')->middleware('permission:Add User');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store')->middleware('permission:Add User');
    Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show')->middleware('permission:Show User');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('permission:Edit User');
    Route::post('/user/update', [UserController::class, 'update'])->name('user.update')->middleware('permission:Edit User');
    Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete')->middleware('permission:Delete User');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles')->middleware('permission:Access Roles');
    Route::get('/role/add', [RoleController::class, 'create'])->name('role.add')->middleware('permission:Add Role');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store')->middleware('permission:Add Role');
    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware('permission:Edit Role');
    Route::post('role/update', [RoleController::class, 'update'])->name('role.update')->middleware('permission:Edit Role');
    Route::get('/role/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete')->middleware('permission:Delete Role');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions')->middleware('permission:Access Permissions');
    Route::get('/permission/add', [PermissionController::class, 'create'])->name('permission.add')->middleware('permission:Add Permission');
    Route::post('/permission/store', [PermissionController::class, 'store'])->name('permission.store')->middleware('permission:Add Permission');
    Route::get('/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit')->middleware('permission:Edit Permission');
    Route::post('permission/update', [PermissionController::class, 'update'])->name('permission.update')->middleware('permission:Edit Permission');
    Route::get('/permission/delete/{id}', [PermissionController::class, 'destroy'])->name('permission.delete')->middleware('permission:Delete Permission');

    Route::get('/services', [ServiceController::class, 'index'])->name('services')->middleware('permission:Access Services');
    Route::get('/service/add', [ServiceController::class, 'create'])->name('service.add')->middleware('permission:Add Service');
    Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store')->middleware('permission:Add Service');
    Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit')->middleware('permission:Edit Service');
    Route::post('/service/update', [ServiceController::class, 'update'])->name('service.update')->middleware('permission:Edit Service');
    Route::get('/service/delete/{id}', [ServiceController::class, 'destroy'])->name('service.delete')->middleware('permission:Delete Service');

    Route::get('/requests', [UserRequestController::class, 'index'])->name('requests')->middleware('permission:Access Requests');
    Route::get('/request/add/{user?}', [UserRequestController::class, 'create'])->name('request.add')->middleware('permission:Add Request');
    Route::post('/request/store', [UserRequestController::class, 'store'])->name('request.store')->middleware('permission:Add Request');
    Route::get('/request/show/{id}', [UserRequestController::class, 'show'])->name('request.show')->middleware('permission:Access Requests');
    Route::get('/request/edit/{id}', [UserRequestController::class, 'edit'])->name('request.edit')->middleware('permission:Edit Request');
    Route::post('/request/update', [UserRequestController::class, 'update'])->name('request.update')->middleware('permission:Edit Request');
    Route::get('/request/delete/{id}', [UserRequestController::class, 'destroy'])->name('request.delete')->middleware('permission:Delete Request');

    Route::get('/preinvoices', [PreinvoiceController::class, 'index'])->name('preinvoices')->middleware('permission:Access Preinvoice');
    Route::get('/preinvoice/create', [PreinvoiceController::class, 'create'])->name('preinvoice.create')->middleware('permission:Add Preinvoice');
    Route::post('/preinvoice/store', [PreinvoiceController::class, 'store'])->name('preinvoice.store')->middleware('permission:Add Preinvoice');
    Route::get('/preinvoice/unofficial/download/{id}', [PreinvoiceController::class, 'download_unofficial'])->name('preinvoice.unofficial.download')->middleware('permission:Download Unofficial PreInvoice');
    Route::get('/preinvoice/custom/unofficial/download/{id}', [PreinvoiceController::class, 'unofficialCustomGoodBoom'])->name('preinvoice.unofficial.custom.download')->middleware('permission:Download Unofficial PreInvoice');
    Route::get('/preinvoice/official/download/{id}', [PreinvoiceController::class, 'download_official'])->name('preinvoice.official.download')->middleware('permission:Download Official PreInvoice');
    Route::get('/preinvoice/show/{id}', [PreinvoiceController::class, 'show'])->name('preinvoice.show')->middleware('permission:Edit Preinvoice');
    Route::get('/preinvoice/edit/{id}', [PreinvoiceController::class, 'edit'])->name('preinvoice.edit')->middleware('permission:Edit Preinvoice');
    Route::post('/preinvoice/update', [PreinvoiceController::class, 'update'])->name('preinvoice.update')->middleware('permission:Edit Preinvoice');
    Route::get('/preinvoice/delete/{id}', [PreinvoiceController::class, 'destroy'])->name('preinvoice.delete')->middleware('permission:Delete Preinvoice');
    Route::get('/preinvoice/change_to_factor/{id}', [PreinvoiceController::class, 'change_to_invoice'])->name('preinvoice.change_to_factor')->middleware('permission:Edit Preinvoice');
    Route::get('/preinvoice/send_to_financial/{id}', [PreinvoiceController::class, 'send_to_financial'])->name('preinvoice.send_to_financial')->middleware('permission:Send To Financial');
    Route::get('/preinvoice/create_charge_card/{id}', [PreinvoiceController::class, 'create_charge_card'])->name('preinvoice.create_charge_card')->middleware('permission:Create Charge Card');
    Route::post('/preinvoice/download_charge_card', [PreinvoiceController::class, 'download_charge_card'])->name('preinvoice.download_charge_card')->middleware('permission:Create Charge Card');


    Route::get('/informations', [InformationController::class, 'index'])->name('informations')->middleware('permission:Access Information');
    Route::get('/information/create', [InformationController::class, 'create'])->name('information.create')->middleware('permission:Add Information');
    Route::post('/information/store', [InformationController::class, 'store'])->name('information.store')->middleware('permission:Add Information');
    Route::get('/information/show/{id}', [InformationController::class, 'show'])->name('information.show')->middleware('permission:Edit Information');
    Route::get('/information/edit/{id}', [InformationController::class, 'edit'])->name('information.edit')->middleware('permission:Edit Information');
    Route::post('/information/update', [InformationController::class, 'update'])->name('information.update')->middleware('permission:Edit Information');
    Route::get('/information/delete/{id}', [InformationController::class, 'destroy'])->name('information.delete')->middleware('permission:Delete Information');

    Route::get('/fireExtinguisherParts', [FireExtinguisherPartController::class, 'index'])->name('fireExtinguisherParts')->middleware('permission:Access FireExtinguisherPart');
    Route::get('/fireExtinguisherPart/create', [FireExtinguisherPartController::class, 'create'])->name('fireExtinguisherPart.create')->middleware('permission:Add FireExtinguisherPart');
    Route::post('/fireExtinguisherPart/store', [FireExtinguisherPartController::class, 'store'])->name('fireExtinguisherPart.store')->middleware('permission:Add FireExtinguisherPart');
    Route::get('/fireExtinguisherPart/show/{id}', [FireExtinguisherPartController::class, 'show'])->name('fireExtinguisherPart.show')->middleware('permission:Edit FireExtinguisherPart');
    Route::get('/fireExtinguisherPart/edit/{id}', [FireExtinguisherPartController::class, 'edit'])->name('fireExtinguisherPart.edit')->middleware('permission:Edit FireExtinguisherPart');
    Route::post('/fireExtinguisherPart/update', [FireExtinguisherPartController::class, 'update'])->name('fireExtinguisherPart.update')->middleware('permission:Edit FireExtinguisherPart');
    Route::get('/fireExtinguisherPart/delete/{id}', [FireExtinguisherPartController::class, 'destroy'])->name('fireExtinguisherPart.delete')->middleware('permission:Delete FireExtinguisherPart');

    Route::get('/transports', [TransporterController::class, 'index'])->name('transports')->middleware('permission:Access Transports');
    Route::get('/transport.done_duty', [TransporterController::class, 'done_duty'])->name('transport.done_duty')->middleware('permission:Access Transports');
    Route::get('/transport/edit/{id}', [TransporterController::class, 'edit'])->name('transport.edit')->middleware('permission:Send Preinvoice To Driver');
    Route::post('/transport/update', [TransporterController::class, 'update'])->name('transport.update')->middleware('permission:Send Preinvoice To Driver');
    Route::get('/transport/driversTaskInfo/{id}', [TransporterController::class, 'driversTaskInfo'])->name('transport.driversTaskInfo')->middleware('permission:Access DriversTask Info');
    Route::get('/transport/viewCustomerRequest/{id}', [TransporterController::class, 'viewCustomerRequest'])->name('transport.viewCustomerRequest')->middleware('permission:Access Customer Request');
    Route::get('/transport/uploadChargeReceipts/{id}', [TransporterController::class, 'uploadChargeReceipts'])->name('transport.uploadChargeReceipts')->middleware('permission:Upload Charge Receipts');
    Route::post('/updateChargeReceipts', [TransporterController::class, 'updateChargeReceipts'])->name('transport.updateChargeReceipts')->middleware('permission:Upload Charge Receipts');
    Route::get('/transport/uploadPaymentReceipts/{id}', [TransporterController::class, 'uploadPaymentReceipts'])->name('transport.uploadPaymentReceipts')->middleware('permission:Upload Payment Receipts');
    Route::post('/updatePaymentReceipts', [TransporterController::class, 'updatePaymentReceipts'])->name('transport.updatePaymentReceipts')->middleware('permission:Upload Payment Receipts');
    Route::get('/transport/driversTasks', [TransporterController::class, 'driversTasks'])->name('transport.driversTasks')->middleware('permission:Access DriversTasks');
    Route::get('/transport/driverDoneTasks', [TransporterController::class, 'driverDoneTasks'])->name('transport.driverDoneTasks')->middleware('permission:Access DriversTasks');
    Route::get('/transport/set_collector_status/{id}', [TransporterController::class, 'set_collector_status'])->name('transport.set_collector_status')->middleware('permission:Set Collector Status');
    Route::post('/transport/update_collector_status', [TransporterController::class, 'update_collector_status'])->name('transport.update_collector_status')->middleware('permission:Set Collector Status');
    Route::get('/transport/set_delivery_status/{id}', [TransporterController::class, 'set_delivery_status'])->name('transport.set_delivery_status')->middleware('permission:Set Delivery Status');
    Route::post('/transport/update_delivery_status', [TransporterController::class, 'update_delivery_status'])->name('transport.update_delivery_status')->middleware('permission:Set Delivery Status');
    Route::get('/transport/done_task/{id}', [TransporterController::class, 'done_task'])->name('transport.done_task')->middleware('permission:Set Delivery Status');
    Route::post('/transport/update_done_task', [TransporterController::class, 'update_done_task'])->name('transport.update_done_task')->middleware('permission:Set Delivery Status');
    Route::get('/transport/show/{id}', [TransporterController::class, 'show'])->name('transport.show')->middleware('permission:Show Transport');
    Route::get('/transport/show_for_driver/{id}', [TransporterController::class, 'show_for_driver'])->name('transport.show_for_driver')->middleware('permission:Show Transport For Driver');

    Route::get('/descriptions', [DescriptionController::class, 'index'])->name('descriptions')->middleware('permission:Access Descriptions');
    Route::get('/description/create', [DescriptionController::class, 'create'])->name('description.create')->middleware('permission:Add Description');
    Route::post('/description/store', [DescriptionController::class, 'store'])->name('description.store')->middleware('permission:Add Description');
    Route::get('/description/show/{id}', [DescriptionController::class, 'show'])->name('description.show')->middleware('permission:Access Description');
    Route::get('/description/edit/{id}', [DescriptionController::class, 'edit'])->name('description.edit')->middleware('permission:Edit Description');
    Route::post('/description/update', [DescriptionController::class, 'update'])->name('description.update')->middleware('permission:Edit Description');
    Route::get('/description/delete/{id}', [DescriptionController::class, 'destroy'])->name('description.delete')->middleware('permission:Delete Description');

    Route::get('/workshop/tasks', [WorkshopController::class, 'index'])->name('workshop.tasks')->middleware('permission:Access Workshop');
    Route::get('/workshop/doneTasks', [WorkshopController::class, 'doneTasks'])->name('workshop.doneTasks')->middleware('permission:Access Workshop Done Tasks');
    Route::get('/workshop/create', [WorkshopController::class, 'create'])->name('workshop.create')->middleware('permission:Add Workshop');
    Route::post('/workshop/store', [WorkshopController::class, 'store'])->name('workshop.store')->middleware('permission:Add Workshop');
    Route::get('/workshop/show/{id}', [WorkshopController::class, 'show'])->name('workshop.show')->middleware('permission:Access Workshop');
    Route::get('/workshop/edit/{id}', [WorkshopController::class, 'edit'])->name('workshop.edit')->middleware('permission:Edit Workshop');
    Route::post('/workshop/update', [WorkshopController::class, 'update'])->name('workshop.update')->middleware('permission:Edit Workshop');
    Route::get('/workshop/delete/{id}', [WorkshopController::class, 'destroy'])->name('workshop.delete')->middleware('permission:Delete Workshop');
    Route::get('/workshop/exit_from_workshop_tasks/{id}', [WorkshopController::class, 'exit_from_workshop_tasks'])->name('workshop.exit_from_workshop_tasks')->middleware('permission:Edit Workshop');

    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices')->middleware('permission:Access Invoices');
    Route::get('/invoice/pending', [InvoiceController::class, 'pending'])->name('invoice.pending')->middleware('permission:Access Pending Invoices');
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create')->middleware('permission:Add Invoice');
    Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('invoice.store')->middleware('permission:Add Invoice');
    Route::get('/invoice/unofficial/download/{id}', [InvoiceController::class, 'download_unofficial'])->name('invoice.unofficial.download')->middleware('permission:Download Unofficial Invoice');
    Route::get('/invoice/official/download/{id}', [InvoiceController::class, 'download_official'])->name('invoice.official.download')->middleware('permission:Download Official Invoice');
    Route::get('/invoice/show/{id}', [InvoiceController::class, 'show'])->name('invoice.show')->middleware('permission:Edit Invoice');
    Route::get('/invoice/edit/{id}', [InvoiceController::class, 'edit'])->name('invoice.edit')->middleware('permission:Edit Invoice');
    Route::post('/invoice/update', [InvoiceController::class, 'update'])->name('invoice.update')->middleware('permission:Edit Invoice');
    Route::get('/invoice/delete/{id}', [InvoiceController::class, 'destroy'])->name('invoice.delete')->middleware('permission:Delete Invoice');
    Route::get('/invoice/create_charge_card/{id}', [InvoiceController::class, 'create_charge_card'])->name('invoice.create_charge_card')->middleware('permission:Create Charge Card');
    Route::post('/invoice/download_charge_card', [InvoiceController::class, 'download_charge_card'])->name('invoice.download_charge_card')->middleware('permission:Create Charge Card');

    Route::get('generate', function () {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        echo 'ok';
    });

    Route::get('/acquaintances', [AcquaintanceController::class, 'index'])->name('acquaintances')->middleware('permission:Access Acquaintances');
    Route::get('/acquaintance/create', [AcquaintanceController::class, 'create'])->name('acquaintance.create')->middleware('permission:Add Acquaintance');
    Route::post('/acquaintance/store', [AcquaintanceController::class, 'store'])->name('acquaintance.store')->middleware('permission:Add Acquaintance');
    Route::get('/acquaintance/show/{id}', [AcquaintanceController::class, 'show'])->name('acquaintance.show')->middleware('permission:Access Acquaintances');
    Route::get('/acquaintance/edit/{id}', [AcquaintanceController::class, 'edit'])->name('acquaintance.edit')->middleware('permission:Edit Acquaintance');
    Route::post('/acquaintance/update', [AcquaintanceController::class, 'update'])->name('acquaintance.update')->middleware('permission:Edit Acquaintance');
    Route::get('/acquaintance/delete/{id}', [AcquaintanceController::class, 'destroy'])->name('acquaintance.delete')->middleware('permission:Delete Acquaintance');

    Route::get('/banks', [BankController::class, 'index'])->name('banks')->middleware('permission:Access Banks');
    Route::get('/bank/create', [BankController::class, 'create'])->name('bank.create')->middleware('permission:Add Bank');
    Route::post('/bank/store', [BankController::class, 'store'])->name('bank.store')->middleware('permission:Add Bank');
    Route::get('/bank/show/{id}', [BankController::class, 'show'])->name('bank.show')->middleware('permission:Access Banks');
    Route::get('/bank/edit/{id}', [BankController::class, 'edit'])->name('bank.edit')->middleware('permission:Edit Bank');
    Route::post('/bank/update', [BankController::class, 'update'])->name('bank.update')->middleware('permission:Edit Bank');
    Route::get('/bank/delete/{id}', [BankController::class, 'destroy'])->name('bank.delete')->middleware('permission:Delete Bank');

    Route::get('/payments/{invoice_id}', [PaymentController::class, 'index'])->name('payments')->middleware('permission:Access Payments');
    Route::get('/payment/create/{invoice_id}', [PaymentController::class, 'create'])->name('payment.create')->middleware('permission:Add Payment');
    Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store')->middleware('permission:Add Payment');
    Route::get('/payment/edit/{id}', [PaymentController::class, 'edit'])->name('payment.edit')->middleware('permission:Edit Payment');
    Route::post('/payment/update', [PaymentController::class, 'update'])->name('payment.update')->middleware('permission:Edit Payment');
    Route::get('/payment/delete/{id}', [PaymentController::class, 'destroy'])->name('payment.delete')->middleware('permission:Delete Payment');
    Route::get('/payment/agree_payment/{id}', [PaymentController::class, 'agree_payment'])->name('payment.agree_payment')->middleware('permission:Agree Payment');
    Route::get('/payment/disagree_payment/{id}', [PaymentController::class, 'disagree_payment'])->name('payment.disagree_payment')->middleware('permission:DisAgree Payment');

    Route::get('/ledger', [LedgerController::class, 'index'])->name('ledger.index')->middleware('permission:Access Ledger');
    Route::get('/ledger/pending', [LedgerController::class, 'pendingApprovals'])->name('ledger.pending')->middleware('permission:Access Ledger');
    Route::get('/ledger/rejected', [LedgerController::class, 'rejected'])->name('ledger.rejected')->middleware('permission:Access Ledger');

    Route::get('/forms', [OfficeFormsController::class, 'index'])->name('forms')->middleware('permission:Access Office Forms');
    Route::get('/form/create/{form_id}', [OfficeFormsController::class, 'create'])->name('form.create')->middleware('permission:Add Office Form');
    Route::post('/form/store', [OfficeFormsController::class, 'store'])->name('form.store')->middleware('permission:Add Office Form');
    Route::get('/form/admins/{form_id}', [OfficeFormsController::class, 'admins'])->name('form.admins')->middleware('permission:Choose Form Received Admins');
    Route::post('/form/update_admins', [OfficeFormsController::class, 'update_admins'])->name('form.update_admins')->middleware('permission:Choose Form Received Admins');

    Route::get('/office_requests', [OfficeRequestsController::class, 'index'])->name('office_requests')->middleware('permission:Access Office Requests');
    Route::get('/office_request/edit/{id}', [OfficeRequestsController::class, 'edit'])->name('office_request.edit')->middleware('permission:Edit Office Request');
    Route::post('/office_request/update', [OfficeRequestsController::class, 'update'])->name('office_request.update')->middleware('permission:Edit Office Request');
    Route::get('/my_office_requests', [OfficeRequestsController::class, 'my_office_requests'])->name('my_office_requests')->middleware('permission:Access Office Requests');
    Route::get('/office_request/create', [OfficeRequestsController::class, 'create'])->name('office_request.create')->middleware('permission:Add Office Request');
    Route::post('/office_request/store', [OfficeRequestsController::class, 'store'])->name('office_request.store')->middleware('permission:Add Office Request');
    Route::get('/office_request/delete/{id}', [OfficeRequestsController::class, 'destroy'])->name('office_request.delete')->middleware('permission:Delete Office Request');
    Route::get('/office_request/show/{id}', [OfficeRequestsController::class, 'show'])->name('office_request.show')->middleware('permission:Show Office Request');

    Route::get('/products', [ProductController::class, 'index'])->name('products')->middleware('permission:Access Products');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create')->middleware('permission:Add Product');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store')->middleware('permission:Add Product');
    Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show')->middleware('permission:Access Products');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit')->middleware('permission:Edit Product');
    Route::post('/product/update', [ProductController::class, 'update'])->name('product.update')->middleware('permission:Edit Product');
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete')->middleware('permission:Delete Product');

    Route::get('/ips', [IPsController::class, 'index'])->name('ips')->middleware('permission:Access IP');
    Route::get('/ip/add', [IPsController::class, 'create'])->name('ip.create')->middleware('permission:Add IP');
    Route::post('/ip/store', [IPsController::class, 'store'])->name('ip.store')->middleware('permission:Add IP');
    Route::get('/ip/edit/{id}', [IPsController::class, 'edit'])->name('ip.edit')->middleware('permission:Edit IP');
    Route::post('/ip/update', [IPsController::class, 'update'])->name('ip.update')->middleware('permission:Edit IP');
    Route::get('/ip/delete/{id}', [IPsController::class, 'destroy'])->name('ip.delete')->middleware('permission:Delete IP');
    Route::get('/invalid', [IPsController::class, 'invalid'])->name('ip.invalid');
    Route::get('/ip/settings', [IPsController::class, 'settings'])->name('ip.settings')->middleware('permission:Access IP Settings');
    Route::post('/ip/store_settings', [IPsController::class, 'store_settings'])->name('ip.store_settings')->middleware('permission:Access IP Settings');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications')->middleware('permission:Access Notifications');
    Route::get('/notification/create', [NotificationController::class, 'create'])->name('notification.create')->middleware('permission:Add Notification');
    Route::post('/notification/store', [NotificationController::class, 'store'])->name('notification.store')->middleware('permission:Add Notification');
    Route::get('/notification/show/{id}', [NotificationController::class, 'show'])->name('notification.show')->middleware('permission:Access Notifications');
    Route::get('/notification/edit/{id}', [NotificationController::class, 'edit'])->name('notification.edit')->middleware('permission:Edit Notification');
    Route::post('/notification/update', [NotificationController::class, 'update'])->name('notification.update')->middleware('permission:Edit Notification');
    Route::get('/notification/delete/{id}', [NotificationController::class, 'destroy'])->name('notification.delete')->middleware('permission:Delete Notification');
    Route::get('/notification/received', [NotificationController::class, 'received'])->name('notification.received')->middleware('permission:Access Received Notifications');
    Route::get('/notification/open/{id}', [NotificationController::class, 'open'])->name('notification.open')->middleware('permission:Access Received Notifications');

    Route::get('/user_supports/{user_id}', [UserSupportController::class, 'index'])->name('user_supports')->middleware('permission:Access User Supports');
    Route::get('/user_support/create/{user_id}', [UserSupportController::class, 'create'])->name('user_support.create')->middleware('permission:Add User Support');
    Route::post('/user_support/store', [UserSupportController::class, 'store'])->name('user_support.store')->middleware('permission:Add User Support');
    Route::get('/user_support/show/{id}', [UserSupportController::class, 'show'])->name('user_support.show')->middleware('permission:Show User Support');
    Route::get('/user_support/edit/{id}', [UserSupportController::class, 'edit'])->name('user_support.edit')->middleware('permission:Edit User Support');
    Route::post('/user_support/update', [UserSupportController::class, 'update'])->name('user_support.update')->middleware('permission:Edit User Support');
    Route::get('/user_support/delete/{id}', [UserSupportController::class, 'destroy'])->name('user_support.delete')->middleware('permission:Delete User Support');
    Route::get('/user_support/nearest', [UserSupportController::class, 'nearest'])->name('user_support.nearest')->middleware('permission:Access Nearest User Supports');

    Route::get('/custom_invoice/preinvoice/create/{preinvoice_id}', [CustomInvoiceController::class, 'create_preinvoice'])->name('custom_invoice.preinvoice.create')->middleware('permission:Create Custom PreInvoice');
    Route::post('/custom_invoice/preinvoice/store', [CustomInvoiceController::class, 'store_preinvoice'])->name('custom_invoice.preinvoice.store')->middleware('permission:Create Custom PreInvoice');
    Route::get('/custom_invoice/invoice/create/{invoice_id}', [CustomInvoiceController::class, 'create_invoice'])->name('custom_invoice.invoice.create')->middleware('permission:Create Custom Invoice');
    Route::post('/custom_invoice/invoice/store', [CustomInvoiceController::class, 'store_invoice'])->name('custom_invoice.invoice.store')->middleware('permission:Create Custom Invoice');

    Route::get('/insurances', [InsuranceController::class, 'index'])->name('insurances')->middleware('permission:Access Insurances');
    Route::get('/insurance/create', [InsuranceController::class, 'create'])->name('insurance.create')->middleware('permission:Add Insurance');
    Route::post('/insurance/store', [InsuranceController::class, 'store'])->name('insurance.store')->middleware('permission:Add Insurance');
    Route::get('/insurance/show/{id}', [InsuranceController::class, 'show'])->name('insurance.show')->middleware('permission:Access Insurances');
    Route::get('/insurance/edit/{id}', [InsuranceController::class, 'edit'])->name('insurance.edit')->middleware('permission:Edit Insurance');
    Route::post('/insurance/update', [InsuranceController::class, 'update'])->name('insurance.update')->middleware('permission:Edit Insurance');
    Route::get('/insurance/delete/{id}', [InsuranceController::class, 'destroy'])->name('insurance.delete')->middleware('permission:Delete Insurance');
    Route::post('/insurance/filter', [InsuranceController::class, 'filter'])->name('insurance.filter')->middleware('permission:Access Insurances');
    Route::get('/insurance/show_pdf/{id}', [InsuranceController::class, 'show_pdf'])->name('insurance.show_pdf')->middleware('permission:Access Insurance Pdf');

    Route::get('/message_reports', [MessageReportController::class, 'index'])->name('message_reports')->middleware('permission:Access Message Reports');
    Route::get('/my_message_reports', [MessageReportController::class, 'my_message_reports'])->name('my_message_reports')->middleware('permission:Access My Message Reports');
    Route::get('/message_report/delete/{id}', [MessageReportController::class, 'destroy'])->name('message_report.delete')->middleware('permission:Delete Message Report');
    Route::get('/message/create', [MessageController::class, 'create'])->name('message.create')->middleware('permission:Add Message');
    Route::post('/message/store', [MessageController::class, 'store'])->name('message.store')->middleware('permission:Add Message');
    Route::get('/message/settings', [MessageController::class, 'settings'])->name('message.settings')->middleware('permission:Access Send Message Settings');
    Route::post('/message/store_settings', [MessageController::class, 'store_settings'])->name('message.store_settings')->middleware('permission:Access Send Message Settings');

    Route::get('/charge_card/settings', [SettingsController::class, 'charge_card'])->name('charge_card.settings')->middleware('permission:Charge Card Settings');
    Route::post('/charge_card/store_settings', [SettingsController::class, 'store_charge_card'])->name('charge_card.store_settings')->middleware('permission:Charge Card Settings');


Route::get('/user/{id}/requests', [UserController::class, 'requests'])->name('user.requests');
Route::get('/user/{id}/preinvoices', [UserController::class, 'preinvoices'])->name('user.preinvoices');
});


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Route::get('/run-system-commands-1', function () {
    
Artisan::call('optimize');
    Artisan::call('storage:link');
    Artisan::call('migrate');
    Artisan::call('preinvoices:backfill-snapshots');
    Artisan::call('transports:backfill-visit-time');
    Artisan::call('preinvoices:backfill-snapshots');
    Artisan::call('roles:assign-all-to-chief-manager');
    Artisan::call('optimize');

    DB::table('menus')
        ->whereIn('url', [
            'ledger.rejected',
            'ledger.pending',
            'ledger.index',
        ])
        ->update([
            'parent_id' => 7
        ]);

    return nl2br(Artisan::output() . "\n\nتمام دستورات با موفقیت اجرا شدند.");
});