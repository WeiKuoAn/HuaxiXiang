<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\GdpaperController;
use App\Http\Controllers\PromController;
use App\Http\Controllers\SaleDataController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\IncomeDataController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\PayDataController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\Rpg01Controller;
use App\Http\Controllers\Rpg02Controller;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

Route::get('/index', function () {
    return view('index');
});



Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [WorkController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [WorkController::class, 'store'])->name('dashboard.worktime');
    /*用戶管理 */
    Route::get('/users', [UserController::class, 'index'])->name('users');

    Route::get('/addusers', [UserController::class, 'create'])->name('users-add');
    Route::post('/addusers', [UserController::class, 'store'])->name('users-add.data');
    Route::get('/users-profile/{id}', [UserController::class, 'show'])->name('users-profile');
    Route::post('/users-profile/{id}', [UserController::class, 'update'])->name('users-profile.data');
    Route::get('/users-password', [UserController::class, 'password_show'])->name('users-password');
    Route::post('/users-password', [UserController::class, 'password_update'])->name('users-password.data');
    /*客戶管理 */
    Route::get('/cust/customer', [CustomerController::class, 'customer'])->name('cust.customer');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::get('/new_customer', [CustomerController::class, 'create'])->name('new-customer');
    Route::post('/new_customer', [CustomerController::class, 'store'])->name('new-customer.data');
    Route::get('/edit_customer/{id}', [CustomerController::class, 'show'])->name('edit-customer');
    Route::post('/edit_customer/{id}', [CustomerController::class, 'update'])->name('edit-customer.data');
    Route::get('/del_customer/{id}', [CustomerController::class, 'destroy'])->name('del-customer');
    Route::post('/del_customer/{id}', [CustomerController::class, 'delete'])->name('del-customer.data');
    /*方案管理 */
    Route::get('/plan', [PlanController::class, 'index'])->name('plan');
    Route::get('/new_plan', [PlanController::class, 'create'])->name('new-plan');
    Route::post('/new_plan', [PlanController::class, 'store'])->name('new-plan.data');
    Route::get('/edit_plan/{id}', [PlanController::class, 'show'])->name('edit-plan');
    Route::post('/edit_plan/{id}', [PlanController::class, 'update'])->name('edit-plan.data');
    /*金紙管理 */
    Route::get('/gdpaper', [GdpaperController::class, 'index'])->name('gdpaper');
    Route::get('/new_gdpaper', [GdpaperController::class, 'create'])->name('new-gdpaper');
    Route::post('/new_gdpaper', [GdpaperController::class, 'store'])->name('new-gdpaper.data');
    Route::get('/edit_gdpaper/{id}', [GdpaperController::class, 'show'])->name('edit-gdpaper');
    Route::post('/edit_gdpaper/{id}', [GdpaperController::class, 'update'])->name('edit-gdpaper.data');
    Route::get('/gdpaper/restock', [GdpaperController::class, 'restock'])->name('gdpaper-restock');
    Route::get('/gdpaper/restock/{id}', [GdpaperController::class, 'restock_show_id'])->name('gdpaper-restock.id');
    Route::get('/gdpaper/new_restock', [GdpaperController::class, 'restock_create'])->name('new-restock');
    Route::post('/gdpaper/new_restock', [GdpaperController::class, 'restock_store'])->name('new-restock.data');
    Route::get('/gdpaper/edit_restock/{id}', [GdpaperController::class, 'restock_show'])->name('edit-restock');
    Route::post('/gdpaper/edit_restock/{id}', [GdpaperController::class, 'restock_update'])->name('edit-restock.data');
    Route::get('/gdpaper/del_restock/{id}', [GdpaperController::class, 'destroy'])->name('del-restock');
    Route::post('/gdpaper/del_restock/{id}', [GdpaperController::class, 'delete'])->name('del-restock.data');
    /*後續方案B管理 */
    Route::get('/promA', [PromController::class, 'promA_index'])->name('promA');
    Route::get('/new_promA', [PromController::class, 'promA_create'])->name('new-promA');
    Route::post('/new_promA', [PromController::class, 'promA_store'])->name('new-promA.data');
    Route::get('/edit_promA/{id}', [PromController::class, 'promA_show'])->name('edit-promA');
    Route::post('/edit_promA/{id}', [PromController::class, 'promA_update'])->name('edit-promA.data');

    /*後續方案B管理 */
    Route::get('/promB', [PromController::class, 'promB_index'])->name('promB');
    Route::get('/new_promB', [PromController::class, 'promB_create'])->name('new-promB');
    Route::post('/new_promB', [PromController::class, 'promB_store'])->name('new-promB.data');
    Route::get('/edit_promB/{id}', [PromController::class, 'promB_show'])->name('edit-promB');
    Route::post('/edit_promB/{id}', [PromController::class, 'promB_update'])->name('edit-promB.data');

    /*收入管理 */
    Route::get('/incomes/suject', [IncomeController::class, 'suject_index'])->name('incomes_suject');
    Route::get('/incomes/new_suject', [IncomeController::class, 'suject_create'])->name('new-income-suject');
    Route::post('/incomes/new_suject', [IncomeController::class, 'suject_store'])->name('new-income-suject.data');
    Route::get('/incomes/edit_suject/{id}', [IncomeController::class, 'suject_show'])->name('edit-income-suject');
    Route::post('/incomes/edit_suject/{id}', [IncomeController::class, 'suject_update'])->name('edit-income-suject.data');

    Route::get('/incomes/data', [IncomeDataController::class, 'index'])->name('incomes');
    Route::get('/incomes/new_data', [IncomeDataController::class, 'create'])->name('new-income');
    Route::post('/incomes/new_data', [IncomeDataController::class, 'store'])->name('new-income.data');
    Route::get('/incomes/edit_data/{id}', [IncomeDataController::class, 'show'])->name('edit-income');
    Route::post('/incomes/edit_data/{id}', [IncomeDataController::class, 'update'])->name('edit-income.data');
    Route::get('/incomes/del_data/{id}', [IncomeDataController::class, 'delshow'])->name('del-income');
    Route::post('/incomes/del_data/{id}', [IncomeDataController::class, 'delete'])->name('del-income.data');

    /*支出管理 */
    Route::get('/pay/suject', [PayController::class, 'index'])->name('pays_suject');
    Route::get('/pay/new_suject', [PayController::class, 'create'])->name('new-pay-suject');
    Route::post('/pay/new_suject', [PayController::class, 'store'])->name('new-pay-suject.data');
    Route::get('/pay/edit_suject/{id}', [PayController::class, 'show'])->name('edit-pay-suject');
    Route::post('/pay/edit_suject/{id}', [PayController::class, 'update'])->name('edit-pay-suject.data');

    /*零用金管理*/
    Route::get('/cashs', [CashController::class, 'index'])->name('cashs');
    Route::get('/cashs/new', [CashController::class, 'create'])->name('new-cash');
    Route::post('/cashs/new', [CashController::class, 'store'])->name('new-cash.data');
    Route::get('/cashs/edit/{id}', [CashController::class, 'show'])->name('edit-cash');
    Route::post('/cashs/edit/{id}', [CashController::class, 'update'])->name('edit-cash.data');
    Route::get('/cashs/del/{id}', [CashController::class, 'destroy'])->name('del-cash');
    Route::post('/cashs/del/{id}', [CashController::class, 'delete'])->name('del-cash.data');

    Route::get('/pay/data', [PayDataController::class, 'index'])->name('pays');
    Route::get('/pay/new_data', [PayDataController::class, 'create'])->name('new-pay');
    Route::post('/pay/new_data', [PayDataController::class, 'store'])->name('new-pay.data');
    Route::get('/pay/edit_data/{id}', [PayDataController::class, 'show'])->name('edit-pay');
    Route::post('/pay/edit_data/{id}', [PayDataController::class, 'update'])->name('edit-pay.data');
    Route::get('/pay/del_data/{id}', [PayDataController::class, 'delshow'])->name('del-pay');
    Route::post('/pay/del_data/{id}', [PayDataController::class, 'delete'])->name('del-pay.data');


    /*業務key單 */
    Route::get('/sale/{id}', [SaleDataController::class, 'user_sale'])->name('user-sale');
    Route::get('/sale', [SaleDataController::class, 'index'])->name('sale');
    Route::get('/new_sale', [SaleDataController::class, 'create'])->name('new-sale');
    Route::post('/new_sale', [SaleDataController::class, 'store'])->name('new-sale.data');
    Route::get('/edit_sale/{id}', [SaleDataController::class, 'show'])->name('edit-sale');
    Route::post('/edit_sale/{id}', [SaleDataController::class, 'update'])->name('edit-sale.data');
    Route::get('/del_sale/{id}', [SaleDataController::class, 'delete'])->name('del-sale');
    Route::post('/del_sale/{id}', [SaleDataController::class, 'destroy'])->name('del-sale.data');
    Route::get('/check_sale/{id}', [SaleDataController::class, 'check'])->name('check-sale');
    Route::post('/check_sale/{id}', [SaleDataController::class, 'check_update'])->name('check-sale.data');
    //業務key單待確認
    Route::get('/wait-sale', [SaleDataController::class, 'wait_index'])->name('wait-sale'); //總確認單
    Route::get('/person/wait-sale', [SaleDataController::class, 'user_wait_index'])->name('user-wait-sale'); //業務看到的確認單
    Route::get('/person/sale', [SaleDataController::class, 'preson_index'])->name('preson-sale');
    //客戶的業務key單
    Route::get('/customer/sale/{id}', [CustomerController::class, 'customer_sale'])->name('customer-sale');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

    //管理者查看使用者出勤畫面
    Route::get('/userwork/{userId}', [WorkController::class, 'userwork'])->middleware(['auth'])->name('userwork');
    //管理者編輯使用者出勤畫面
    Route::get('/edituserwork/{workId}', [WorkController::class, 'showuserwork'])->middleware(['auth'])->name('editUserWork');
    Route::post('/edituserwork/{workId}', [WorkController::class, 'edituserwork'])->middleware(['auth'])->name('editUserWork.data');

    //管理者刪除使用者出勤畫面
    Route::get('/deluserwork/{workId}', [WorkController::class, 'showdeluserwork'])->middleware(['auth'])->name('delUserWork');
    Route::post('/deluserwork/{workId}', [WorkController::class, 'deluserwork'])->middleware(['auth'])->name('delUserWork.data');
    //使用者出勤畫面
    Route::get('/personwork', [WorkController::class, 'personwork'])->middleware(['auth'])->name('personwork');

    //報表管理
    Route::get('/rpg/rpg01', [Rpg01Controller::class, 'rpg01'])->middleware(['auth'])->name('rpg01');
    Route::get('/rpg/rpg02', [Rpg02Controller::class, 'rpg02'])->middleware(['auth'])->name('rpg02');
    Route::get('/rpg/rpg03', [Rpg03Controller::class, 'rpg03'])->middleware(['auth'])->name('rpg03');
});


require __DIR__ . '/auth.php';
