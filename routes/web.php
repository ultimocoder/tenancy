<?php

use Illuminate\Support\Facades\Route;
use App\Models\Package;
use App\Models\PackageFeature;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 
//https://builtdemo.info/tenancy/public/

Route::get('/', function () {
    //return view('welcome');
    $package = Package::where('status', true)->get();
    $packageFeatures = PackageFeature::where('status', true)->get();
    return view('front.index', compact('package','packageFeatures'));
});

Route::get('/plan-and-pricing/{id}',  [App\Http\Controllers\PackagePriceController::class, 'index']);
Route::get('/plan/{id}',  [App\Http\Controllers\PackagePriceController::class, 'plan']);


Route::get('/user-login', function () {
    return view('front.user_login');
});
// Route::get('/user-sign-up', function () {
//     return view('front.user_sign_up');
// });
Auth::routes();

Route::get('/user-sign-up/{param1}/{param2}', [App\Http\Controllers\SignUpController::class, 'userSignUp'])->name('user-sign-up');
Route::post('/subscription', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscription.index');

Route::get('/stripeCheckout', [App\Http\Controllers\SubscriptionController::class, 'stripeCheckoutSuccess'])->name('stripe.checkout.success');
Route::get('/success', [App\Http\Controllers\SubscriptionController::class, 'success'])->name('success');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//landlord routes

//Route::get('/landlord/tenant-information', [App\Http\Controllers\HomeController::class, 'tenantInformation'])->name('landlord.tenant-information');


//landlord property
Route::get('/landlord/property/list', [App\Http\Controllers\Landlord\PropertyController::class, 'list'])->name('landlord.property');
Route::get('/landlord/property/view', [App\Http\Controllers\Landlord\PropertyController::class, 'view'])->name('landlord.view.property');
Route::get('/landlord/property/edit', [App\Http\Controllers\Landlord\PropertyController::class, 'edit'])->name('landlord.edit.property');

Route::get('/landlord/new-property-create', [App\Http\Controllers\Landlord\PropertyController::class, 'createProperty'])->name('landlord.property.create');
Route::post('/landlord/new-property-save', [App\Http\Controllers\Landlord\PropertyController::class, 'saveProperty'])->name('landlord.property.save');
Route::get('/landlord/property/edit/{id}', [App\Http\Controllers\Landlord\PropertyController::class, 'editProperty'])->name('landlord.property.edit');
Route::get('/landlord/property/view/{id}', [App\Http\Controllers\Landlord\PropertyController::class, 'viewPropertyUnit'])->name('landlord.property.view');
Route::post('/landlord/property/update', [App\Http\Controllers\Landlord\PropertyController::class, 'updateProperty'])->name('landlord.property.update');
Route::delete('/landlord/property/unit/delete', [App\Http\Controllers\Landlord\PropertyController::class, 'deletePropertyUnit'])->name('landlord.property.unit.delete');


 
//landlord tenant
Route::get('/landlord/new-tenant-create', [App\Http\Controllers\Landlord\TenantController::class, 'createTenant'])->name('landlord.new.tenant');
Route::get('/landlord/new-tenant-create/{id}', [App\Http\Controllers\Landlord\TenantController::class, 'createTenantFromUnit'])->name('landlord.new.tenant.unit');

Route::post('/landlord/new-tenant-save', [App\Http\Controllers\Landlord\TenantController::class, 'saveTenant'])->name('landlord.tenant.save');
Route::get('/landlord/tenant-advanced-search-create', [App\Http\Controllers\Landlord\TenantController::class, 'tenantAdvancedSearchCreate'])->name('landlord.tenant.advanced.search');
Route::get('/landlord/tenant-advanced-search', [App\Http\Controllers\Landlord\TenantController::class, 'tenantAdvancedSearch'])->name('landlord.advanced.search.tenant');
Route::post('/landlord/tenant-dashboard-search-create', [App\Http\Controllers\Landlord\TenantController::class, 'tenantDashboardSearch'])->name('landlord.tenant.dashboard.search');
Route::post('/landlord/fetch-property-unit', [App\Http\Controllers\Landlord\PropertyController::class, 'fetchPropertyUnit'])->name('landlord.fetch.property.unit');
Route::get('/landlord/tenant-info/{id?}', [App\Http\Controllers\Landlord\TenantController::class, 'tenantInfo'])->name('landlord.tenant-information');
Route::get('/landlord/tenant/edit/{id}', [App\Http\Controllers\Landlord\TenantController::class, 'tenantEdit'])->name('landlord.tenant.edit');
Route::post('/landlord/tenant/update', [App\Http\Controllers\Landlord\TenantController::class, 'tenantUpdate'])->name('landlord.tenant.update');
Route::get('/landlord/tenant/delete-photo/{id}', [App\Http\Controllers\Landlord\TenantController::class, 'deletePhoto'])->name('landlord.tenant.remove.photo');
Route::get('/landlord/tenant-additional-info/{id?}', [App\Http\Controllers\Landlord\TenantController::class, 'tenantAdditionalInfo'])->name('landlord.tenant-additional-information');
Route::get('/landlord/tenant/additional-information/edit/{id}', [App\Http\Controllers\Landlord\TenantController::class, 'tenantEditAdditional'])->name('landlord.tenant.additional.edit');
Route::delete('/landlord/tenant/session/delete', [App\Http\Controllers\Landlord\TenantController::class, 'deleteTenantSession'])->name('landlord.tenant.session.delete');

// Route::get('/landlord/tenant/list', [App\Http\Controllers\Landlord\TenantController::class, 'tenantList'])->name('landlord.tenants');


//landlord document

Route::get('/landlord/document', [App\Http\Controllers\Landlord\DocumentController::class, 'document'])->name('landlord.document');
Route::post('/landlord/document/save', [App\Http\Controllers\Landlord\DocumentController::class, 'store'])->name('landlord.document.save');
Route::get('/landlord/document/download/{id}', [App\Http\Controllers\Landlord\DocumentController::class, 'download'])->name('landlord.document.download');
Route::get('/landlord/document/edit/list', [App\Http\Controllers\Landlord\DocumentController::class, 'documentEditList'])->name('landlord.document.edit');
Route::get('/landlord/document/delete', [App\Http\Controllers\Landlord\DocumentController::class, 'documentDelete'])->name('landlord.document.delete');
Route::get('/landlord/document/changeStatus', [App\Http\Controllers\Landlord\DocumentController::class, 'changeStatus'])->name('landlord.document.changeStatus');
Route::delete('/landlord/document/deleteAll', [App\Http\Controllers\Landlord\DocumentController::class, 'deleteAll'])->name('landlord.multiple.document.delete');

//landlord expenses
Route::get('/landlord/add/expenses', [App\Http\Controllers\Landlord\ExpenseController::class, 'create'])->name('landlord.add.expenses');
Route::post('/landlord/expenses/save', [App\Http\Controllers\Landlord\ExpenseController::class, 'store'])->name('landlord.expenses.save');
Route::get('/landlord/list/expenses', [App\Http\Controllers\Landlord\ExpenseController::class, 'list'])->name('landlord.list.expenses');
Route::get('/landlord/expenses/list', [App\Http\Controllers\Landlord\ExpenseController::class, 'expenseLists'])->name('landlord.expenses.list');
Route::get("/landlord/expense/delete/{id}", [App\Http\Controllers\Landlord\ExpenseController::class, 'destroy'])->name('landlord.expenses.delete');
Route::get('/landlord/expense/view/{id}', [App\Http\Controllers\Landlord\ExpenseController::class, 'viewExpense']);
Route::get('/landlord/expense/edit/{id}', [App\Http\Controllers\Landlord\ExpenseController::class, 'editExpense'])->name('landlord.expenses.edit');
Route::post('/landlord/expense/update', [App\Http\Controllers\Landlord\ExpenseController::class, 'updateExpense'])->name('landlord.expenses.update');

// landlord account
Route::get('/landlord/profile-section', [App\Http\Controllers\Landlord\AccountController::class, 'profile'])->name('landlord.profile');
Route::get('/landlord/profile/edit', [App\Http\Controllers\Landlord\AccountController::class, 'profileEdit'])->name('landlord.profile.edit');
Route::post('/landlord/profile/update', [App\Http\Controllers\Landlord\AccountController::class, 'profileUpdate'])->name('landlord.profile.update');
Route::get('/landlord/account-and-security', [App\Http\Controllers\Landlord\AccountController::class, 'account'])->name('landlord.account.security');
Route::get('/landlord/account-password-change', [App\Http\Controllers\Landlord\AccountController::class, 'accountPasswordChange'])->name('landlord.account.password.change');
Route::post('/landlord/account-password-save', [App\Http\Controllers\Landlord\AccountController::class, 'accountPasswordSave'])->name('landlord.password.save');
Route::get('/landlord/account-username-change', [App\Http\Controllers\Landlord\AccountController::class, 'accountUsernameChange'])->name('landlord.account.username.change');
Route::post('/landlord/account-username-save', [App\Http\Controllers\Landlord\AccountController::class, 'accountUsernameSave'])->name('landlord.username.save');

//landlord account billing
Route::get('/landlord/account/billing', [App\Http\Controllers\Landlord\AccountController::class, 'billing'])->name('landlord.account.billing');
Route::get('/landlord/account/invoice/list', [App\Http\Controllers\Landlord\AccountController::class, 'invoiceList'])->name('landlord.account.invoice.list');
Route::get('/landlord/account/invoice/{id}', [App\Http\Controllers\Landlord\AccountController::class, 'invoiceById'])->name('landlord.account.invoice');


// Route::get('/landlord/account/payment/info', [App\Http\Controllers\Landlord\AccountController::class, 'paymentInfo'])->name('landlord.account.payment.info');
// Route::get('/landlord/account/payment/edit', [App\Http\Controllers\Landlord\AccountController::class, 'paymentEdit'])->name('landlord.account.payment.edit');

//landlord subscription
Route::get('/landlord/account/subscription', [App\Http\Controllers\Landlord\AccountController::class, 'subscription'])->name('landlord.account.subscription');
Route::get('/landlord/account/subscription/info/{id}', [App\Http\Controllers\Landlord\AccountController::class, 'subscriptionInfo'])->name('landlord.account.subscription.info');
Route::get('/landlord/account/subscription/change-plan', [App\Http\Controllers\Landlord\AccountController::class, 'ChangePlan'])->name('landlord.account.subscription.change.plan');
Route::get('/landlord/account/subscription/cancelation', [App\Http\Controllers\Landlord\AccountController::class, 'cancelation'])->name('landlord.account.subscription.cancelation');
Route::post('/landlord/account/subscription/cancelation-post', [App\Http\Controllers\Landlord\AccountController::class, 'cancelationPost'])->name('landlord.account.subscription.cancelation.post');
Route::post('/landlord/account/subscription/subscription-status-change', [App\Http\Controllers\Landlord\AccountController::class, 'SubscriptionStatusChange'])->name('landlord.account.subscription.changeStatus');
Route::get('/landlord/account/subscription/subscription-billing-cycle/{unit}/{pid}', [App\Http\Controllers\Landlord\AccountController::class, 'BillingCycle'])->name('billing.cycle');
Route::post('/landlord/account/subscription/update', [App\Http\Controllers\Landlord\AccountController::class, 'SubscriptionUpdate'])->name('landlord.account.subscription.update');
Route::get('/landlord/account/subscription/review-order/{unit}/{id}/{cycle}', [App\Http\Controllers\Landlord\AccountController::class, 'reviewOrder'])->name('landlord.account.subscription.review.order');
Route::get('/landlord/account/subscription/deactivate-unit/{unit}', [App\Http\Controllers\Landlord\PropertyController::class, 'deactivateUnit'])->name('landlord.account.deactivate.unit');
Route::post('/landlord/account/subscription/deactivate-unit', [App\Http\Controllers\Landlord\AccountController::class, 'deactivatePropertyUnit'])->name('landlord.account.deactivate.property');
Route::get('/landlord/account/subscription/downgrade-billing-cycle/{unit}/{pid}', [App\Http\Controllers\Landlord\AccountController::class, 'downgradeBillingCycle'])->name('downgrade.billing.cycle');
Route::get('/landlord/account/subscription/downgrade-review-order/{unit}/{id}/{cycle}', [App\Http\Controllers\Landlord\AccountController::class, 'downgradeReviewOrder'])->name('landlord.account.downgrade.review.order');


Route::get('/landlord/account/subscription/renew-plan', [App\Http\Controllers\Landlord\AccountController::class, 'RenewPlan'])->name('landlord.account.subscription.renew.plan');
Route::get('/landlord/account/subscription/subscription-renew-billing-cycle/{unit}/{pid}', [App\Http\Controllers\Landlord\AccountController::class, 'RenewBillingCycle'])->name('billing.cycle.renew');
Route::get('/landlord/account/subscription/renew-order/{unit}/{id}/{cycle}', [App\Http\Controllers\Landlord\AccountController::class, 'renewOrder'])->name('landlord.account.subscription.renew.order');
Route::post('/landlord/account/subscription/store', [App\Http\Controllers\Landlord\AccountController::class, 'SubscriptionStore'])->name('landlord.account.subscription.store');


//landlord payment
Route::get('/landlord/account/payment/info', [App\Http\Controllers\Landlord\AccountController::class, 'paymentInfo'])->name('landlord.account.payment.info');
Route::get('/landlord/account/payment/edit', [App\Http\Controllers\Landlord\AccountController::class, 'paymentEdit'])->name('landlord.account.payment.edit');
Route::post('/landlord/account/payment/info/save', [App\Http\Controllers\Landlord\AccountController::class, 'paymentInfoSave'])->name('landlord.account.payment.info.save');

Route::get('/landlord/account/payment/add-card', [App\Http\Controllers\Landlord\AccountController::class, 'add'])->name('add.card');
Route::post('stripe', [App\Http\Controllers\Landlord\AccountController::class, 'stripePost'])->name('stripe.post');


// Admin Routes

    Route::get('/admin-login', function () {
        return view('admin.admin_login');
    });
    Route::post('/login', [App\Http\Controllers\admin\loginController::class, 'loginpost']);
    // Route::get('/admin-login', [App\Http\Controllers\admin\loginController::class, 'index']);
    Route::get('/admin-dashboard', [App\Http\Controllers\admin\loginController::class, 'dashboard']);
    
    // Route::get('/admin-login', [App\Http\Controllers\admin\loginController::class, 'index']);
    Route::group(['middleware' => 'guid'], function () {
        
    
    Route::get('/admin-profile',[App\Http\Controllers\admin\loginController::class,'admin_profile']);
    //property url
    Route::get('/properties', [App\Http\Controllers\admin\PropertyController::class, 'properties'])->name('properties');
    
    Route::get('/property-view/{id}', [App\Http\Controllers\admin\PropertyController::class, 'property_view'])->name('property-view');
    
    Route::get('/tenantinformation', [App\Http\Controllers\admin\TenantController::class, 'tenant_info']);
    Route::get('/tenant-information-view/{id}', [App\Http\Controllers\admin\TenantController::class, 'tenant_info_view'])->name('tenant-view');
    
    Route::get('/new-tenant', [App\Http\Controllers\admin\TenantController::class, 'new_tenant']);
    Route::get('/register-new-tenant', [App\Http\Controllers\admin\TenantController::class, 'register_new_tenant']);
    
    //correspondence
    Route::get('/userlisting', [App\Http\Controllers\admin\UserController::class, 'index'])->name('userlisting');
    Route::get('/user-view/{id}', [App\Http\Controllers\admin\UserController::class, 'view_user'])->name('user-view');
    Route::get('/logout',[App\Http\Controllers\admin\loginController::class,'logout'])->name('logout');
    


   
});

//Tenant Routes
Route::get('/tenant/login', function () {
    return view('auth.tenant_login');
});
Route::post('/login', [App\Http\Controllers\Tenant\TenantLoginController::class, 'tenantloginpost']);
Route::group(['middleware' => 'guidtenant'], function () {

Route::get('/tenant-dashboard', [App\Http\Controllers\Tenant\TenantLoginController::class, 'tenantdashboard'])->name('tenant-dashboard');
Route::get('/tenantlogout',[App\Http\Controllers\Tenant\TenantLoginController::class,'tenantlogout'])->name('tenantlogout');

//Tenant Profile Routes
Route::get('/tenant/profile-section', [App\Http\Controllers\Tenant\TenantAccountController::class, 'profile'])->name('tenant.profile');
Route::get('/tenant/profile/edit', [App\Http\Controllers\Tenant\TenantAccountController::class, 'profileEdit'])->name('tenant.profile.edit');
Route::post('/tenant/profile/update', [App\Http\Controllers\Tenant\TenantAccountController::class, 'profileUpdate'])->name('tenant.profile.update');
Route::get('/tenant/account-and-security', [App\Http\Controllers\Tenant\TenantAccountController::class, 'account'])->name('tenant.account.security');
Route::get('/tenant/account-password-change', [App\Http\Controllers\Tenant\TenantAccountController::class, 'accountPasswordChange'])->name('tenant.account.password.change');
Route::get('/tenant/account-username-change', [App\Http\Controllers\Tenant\TenantAccountController::class, 'accountUsernameChange'])->name('tenant.account.username.change');
Route::post('/tenant/account-username-save', [App\Http\Controllers\Tenant\TenantAccountController::class, 'accountUsernameSave'])->name('tenant.username.save');
Route::post('/tenant/account-password-save', [App\Http\Controllers\Tenant\TenantAccountController::class, 'accountPasswordSave'])->name('tenant.password.save');

Route::get('/tenant/tenant-info/', [App\Http\Controllers\Tenant\TenantInfoController::class, 'tenantInfo'])->name('tenant.tenant-information');
Route::get('/tenant/tenant/edit/{id}', [App\Http\Controllers\Tenant\TenantInfoController::class, 'tenantEdit'])->name('tenant.tenant.edit');
Route::post('/tenant/tenant/update', [App\Http\Controllers\Tenant\TenantInfoController::class, 'tenantUpdate'])->name('tenant.tenant.update');
Route::get('/tenant/tenant/delete-photo/{id}', [App\Http\Controllers\Tenant\TenantInfoController::class, 'deletePhoto'])->name('tenant.tenant.remove.photo');
Route::get('/tenant/tenant-additional-info/', [App\Http\Controllers\Tenant\TenantInfoController::class, 'tenantAdditionalInfo'])->name('tenant.tenant-additional-information');
});