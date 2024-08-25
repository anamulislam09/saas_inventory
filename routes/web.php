<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BasicInfoController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CollectionController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\expense\ExpenseCategoryController;
use App\Http\Controllers\admin\expense\ExpenseController;
use App\Http\Controllers\admin\expense\ExpenseHeadController;
use App\Http\Controllers\admin\hrm\AttendanceController;
use App\Http\Controllers\admin\hrm\AttendanceProcessController;
use App\Http\Controllers\admin\hrm\DepartmentController;
use App\Http\Controllers\admin\hrm\DesignationController;
use App\Http\Controllers\admin\hrm\DivisionController;
use App\Http\Controllers\admin\hrm\EmployeeController;
use App\Http\Controllers\admin\hrm\HolidayController;
use App\Http\Controllers\admin\hrm\HRSettingController;
use App\Http\Controllers\admin\hrm\LeaveController;
use App\Http\Controllers\admin\hrm\LeaveTypeController;
use App\Http\Controllers\admin\hrm\LoanController;
use App\Http\Controllers\admin\hrm\SalaryController;
use App\Http\Controllers\admin\hrm\SalaryProcessController;
use App\Http\Controllers\admin\hrm\WeeklyHolidayController;
use App\Http\Controllers\admin\IssueItemController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\PaymentMethodController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductionPlanController;
use App\Http\Controllers\admin\PurchaseController;
use App\Http\Controllers\admin\PurchaseRequisitionController;
use App\Http\Controllers\admin\RecipeController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\SupplierController;
use App\Http\Controllers\admin\UnitController;
use App\Http\Controllers\admin\VendorController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\SuperAdmin\ClientController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;



Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return 'View cache has been cleared';
});

Route::macro('redirectMany', function (array $routes, string $destination) {
    foreach ($routes as $route) {
        Route::get($route, fn() => redirect()->route($destination));
    }
});
Route::redirectMany(['/', '/login', '/admin'], 'admin.login');
Route::prefix('admin')->group(function () {
    route::namespace('App\Http\Controllers\admin')->group(function () {
        Route::match(['get', 'post'], 'login', [AdminController::class, 'login'])->name('admin.login');
        Route::middleware('admin')->group(function () {
            Route::prefix('menus')->controller(MenuController::class)->group(function () {
                Route::get('', 'index')->name('menus.index');
                Route::get('create', 'createOrEdit')->name('menus.create');
                Route::get('edit/{id?}/{addmenu?}', 'createOrEdit')->name('menus.edit');
                Route::post('store', 'store')->name('menus.store');
                Route::put('update/{id}', 'update')->name('menus.update');
                Route::delete('delete/{id}', 'destroy')->name('menus.destroy');
            });

            /*-------------------------- create client route start here----------------------*/
            Route::get('/clients/index', [ClientController::class, 'index'])->name('clients.index');
            Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
            Route::post('/client/store', [ClientController::class, 'store'])->name('client.store');
            Route::get('/client/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
            Route::post('/client/update', [ClientController::class, 'update'])->name('client.update');
            Route::post('/client/destroy', [ClientController::class, 'destroy'])->name('client.destroy');
            /*-------------------------- create client route ends here----------------------*/

            Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

            // Route::prefix('dashboard')->group(function () {
            //     Route::prefix('kitchen')->controller(KitchenController::class)->group(function(){
            //         Route::get('', 'index')->name('kitchen.index');
            //         Route::get('orders', 'orders')->name('kitchen.orders');
            //         Route::get('order-status/{indicator}/{id}', 'updateStatus')->name('kitchen.update.status');
            //     });
            Route::prefix('dashboard')->controller(DashboardController::class)->group(function () {
                Route::get('', 'index')->name('dashboard.index');
                Route::get('pendings', 'pendings')->name('dashboard.pendings');
            });
            // });

            /*-------------------------- create client route start here----------------------*/
            Route::prefix('basic-setup')->group(function () {
                Route::prefix('basic-infos')->controller(BasicInfoController::class)->group(function () {
                    Route::get('', 'index')->name('basic-infos.index');
                    Route::put('update/{id}', 'update')->name('basic-infos.update');
                    Route::get('edit/{id?}', 'edit')->name('basic-infos.edit');
                });
                Route::prefix('roles')->controller(RoleController::class)->group(function () {
                    Route::get('', 'index')->name('roles.index');
                    Route::get('create', 'createOrEdit')->name('roles.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('roles.edit');
                    Route::post('store', 'store')->name('roles.store');
                    Route::put('update/{id}', 'update')->name('roles.update');
                    Route::delete('delete/{id}', 'destroy')->name('roles.destroy');
                });
                Route::prefix('admins')->controller(AdminController::class)->group(function () {
                    Route::get('', 'index')->name('admins.index');
                    Route::get('create', 'createOrEdit')->name('admins.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('admins.edit');
                    Route::post('store', 'store')->name('admins.store');
                    Route::put('update/{id}', 'update')->name('admins.update');
                    Route::delete('delete/{id}', 'destroy')->name('admins.destroy');
                });

                Route::prefix('units')->controller(UnitController::class)->group(function () {
                    Route::match(['get', 'post'], '', 'index')->name('units.index');
                    Route::get('create', 'createOrEdit')->name('units.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('units.edit');
                    Route::post('store', 'store')->name('units.store');
                    Route::put('update/{id}', 'update')->name('units.update');
                    Route::delete('delete/{id}', 'destroy')->name('units.destroy');
                });

                /*-------------------------- payment-methods route start here----------------------*/
                Route::prefix('payment-methods')->controller(PaymentMethodController::class)->group(function () {
                    Route::get('', 'index')->name('payment-methods.index');
                    Route::post('store', 'store')->name('payment-methods.store');
                    Route::put('update/{id}', 'update')->name('payment-methods.update');
                    Route::get('create', 'createOrEdit')->name('payment-methods.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('payment-methods.edit');
                    Route::delete('delete/{id}', 'destroy')->name('payment-methods.destroy');
                });
                /*-------------------------- payment-methods route ends here----------------------*/

                Route::prefix('password')->controller(AdminController::class)->group(function () {
                    Route::match(['get', 'post'], 'update/{id?}', 'updatePassword')->name('admin.password.update');
                    Route::post('check-password', 'checkPassword')->name('admin.password.check');
                });
                Route::prefix('profile')->controller(AdminController::class)->group(function () {
                    Route::match(['get', 'post'], 'update-details/{id?}', 'updateDetails')->name('profile.update-details');;
                });
            });
            /*-------------------------- create client route ends here----------------------*/

            /*-------------------------- Category route ends here----------------------*/
            Route::prefix('categories')->controller(CategoryController::class)->group(function () {
                Route::get('', 'index')->name('categories.index');
                Route::get('create', 'createOrEdit')->name('categories.create');
                Route::get('edit/{id?}', 'createOrEdit')->name('categories.edit');
                Route::post('store', 'store')->name('categories.store');
                Route::put('update/{id}', 'update')->name('categories.update');
                Route::delete('delete/{id}', 'destroy')->name('categories.destroy');
            });
            /*-------------------------- Category route ends here----------------------*/

            /*-------------------------- subCategory route start here----------------------*/
            Route::prefix('sub-categories')->controller(SubCategoryController::class)->group(function () {
                Route::get('', 'index')->name('sub-categories.index');
                Route::get('create', 'createOrEdit')->name('sub-categories.create');
                Route::get('edit/{id?}', 'createOrEdit')->name('sub-categories.edit');
                Route::post('store', 'store')->name('sub-categories.store');
                Route::put('update/{id}', 'update')->name('sub-categories.update');
                Route::delete('delete/{id}', 'destroy')->name('sub-categories.destroy');
            });
            /*-------------------------- subCategory route ends here----------------------*/

            /*-------------------------- products route start here----------------------*/
            Route::prefix('products')->controller(ProductController::class)->group(function () {
                Route::get('get', 'index')->name('products.index');
                Route::get('create', 'create')->name('products.create');
                Route::get('edit/{id}', 'edit')->name('products.edit');
                Route::post('store', 'store')->name('products.store');
                Route::post('update', 'update')->name('products.update');
                Route::delete('delete/{id}', 'destroy')->name('products.destroy');
                Route::get('sub_category/{catId}', 'subCategory')->name("products.sub-category");
            });
            /*-------------------------- products route ends here----------------------*/

            /*-------------------------- vendor route start here----------------------*/
            Route::prefix('vendors')->controller(VendorController::class)->group(function () {
                Route::get('', 'index')->name('vendors.index');
                Route::post('store', 'store')->name('vendors.store');
                Route::put('update/{id}', 'update')->name('vendors.update');
                Route::get('create', 'createOrEdit')->name('vendors.create');
                Route::get('edit/{id?}', 'createOrEdit')->name('vendors.edit');
                Route::delete('delete/{id}', 'destroy')->name('vendors.destroy');
            });
            /*-------------------------- vendor route ends here----------------------*/

            /*-------------------------- purchases route start here----------------------*/
            Route::prefix('purchases')->controller(PurchaseController::class)->group(function () {
                Route::get('', 'index')->name('purchases.index');
                Route::post('store', 'store')->name('purchases.store');
                Route::get('create', 'createOrEdit')->name('purchases.create');
                Route::get('vouchar/{id}', 'vouchar')->name('purchases.vouchar');
                Route::get('vouchar/{id}/{print}', 'vouchar')->name('purchases.vouchar.print');
                Route::post('payment/store', 'payment')->name('purchases.payment.store');
                Route::delete('payment/destroy', 'destroy')->name('purchases.payment.destroy');
                Route::get('purchase-requisition/{vouchar_no}', 'purchaseRequisition')->name('purchase-orders.purchase-requisition');
            });
            /*-------------------------- purchases route ends here----------------------*/

            /*-------------------------- purchases return route start here----------------------*/
            Route::prefix('purchase-return')->controller(PurchaseReturnController::class)->group(function () {
                Route::get('', 'index')->name('purchase-return.index');
                Route::get('create', 'createOrEdit')->name('purchase-return.create');
                Route::post('store', 'store')->name('purchase-return.store');
              
            });
            /*-------------------------- purchases return route ends here----------------------*/


            Route::prefix('reports')->controller(ReportController::class)->group(function () {
                Route::match(['get', 'post'], 'vendor-ledgers', 'vendorLedgers')->name('reports.vendor-ledgers');
                Route::match(['get', 'post'], 'purchase', 'purchase')->name('reports.purchase');
                Route::match(['get', 'post'], 'sales', 'sales')->name('reports.sales');
                Route::match(['get', 'post'], 'stocks', 'stocks')->name('reports.stocks');
                Route::match(['get', 'post'], 'collections', 'collections')->name('reports.collections');
            });
        });
    });

    //Human Resource Manager Module Routes
    route::namespace('App\Http\Controllers\admin\hrm')->group(function () {
        Route::prefix('hrm')->middleware('admin')->group(function () {
            Route::prefix('setup')->group(function () {
                Route::prefix('hrsettings')->controller(HRSettingController::class)->group(function () {
                    Route::get('', 'index')->name('hrsettings.index');
                    Route::get('edit/{id?}', 'createOrEdit')->name('hrsettings.edit');
                    Route::put('update/{id}', 'update')->name('hrsettings.update');
                });
                Route::prefix('departments')->controller(DepartmentController::class)->group(function () {
                    Route::get('', 'index')->name('departments.index');
                    Route::get('create', 'createOrEdit')->name('departments.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('departments.edit');
                    Route::post('store', 'store')->name('departments.store');
                    Route::put('update/{id}', 'update')->name('departments.update');
                    Route::delete('delete/{id}', 'destroy')->name('departments.destroy');
                });
                Route::prefix('divisions')->controller(DivisionController::class)->group(function () {
                    Route::get('', 'index')->name('divisions.index');
                    Route::get('create', 'createOrEdit')->name('divisions.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('divisions.edit');
                    Route::post('store', 'store')->name('divisions.store');
                    Route::put('update/{id}', 'update')->name('divisions.update');
                    Route::delete('delete/{id}', 'destroy')->name('divisions.destroy');
                });
                Route::prefix('designations')->controller(DesignationController::class)->group(function () {
                    Route::get('', 'index')->name('designations.index');
                    Route::get('create', 'createOrEdit')->name('designations.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('designations.edit');
                    Route::post('store', 'store')->name('designations.store');
                    Route::put('update/{id}', 'update')->name('designations.update');
                    Route::delete('delete/{id}', 'destroy')->name('designations.destroy');
                });
                Route::prefix('employees')->controller(EmployeeController::class)->group(function () {
                    Route::get('', 'index')->name('employees.index');
                    Route::get('create', 'createOrEdit')->name('employees.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('employees.edit');
                    Route::post('store', 'store')->name('employees.store');
                    Route::put('update/{id}', 'update')->name('employees.update');
                    Route::delete('delete/{id}', 'destroy')->name('employees.destroy');
                });
                Route::prefix('leave-types')->controller(LeaveTypeController::class)->group(function () {
                    Route::get('', 'index')->name('leave-types.index');
                    Route::get('create', 'createOrEdit')->name('leave-types.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('leave-types.edit');
                    Route::post('store', 'store')->name('leave-types.store');
                    Route::put('update/{id}', 'update')->name('leave-types.update');
                    Route::delete('delete/{id}', 'destroy')->name('leave-types.destroy');
                });
                Route::prefix('holidays')->controller(HolidayController::class)->group(function () {
                    Route::get('', 'index')->name('holidays.index');
                    Route::get('create', 'createOrEdit')->name('holidays.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('holidays.edit');
                    Route::post('store', 'store')->name('holidays.store');
                    Route::put('update/{id}', 'update')->name('holidays.update');
                    Route::delete('delete/{id}', 'destroy')->name('holidays.destroy');
                    Route::post('holidays-by-date', 'holidaysByDate')->name('holidays.holidays-by-date');
                });
                Route::prefix('weekly-holidays')->controller(WeeklyHolidayController::class)->group(function () {
                    Route::get('', 'index')->name('weekly-holidays.index');
                    Route::get('edit/{id?}', 'createOrEdit')->name('weekly-holidays.edit');
                    Route::put('update/{id}', 'update')->name('weekly-holidays.update');
                });
            });
            Route::prefix('attendances')->group(function () {
                Route::prefix('attendances')->controller(AttendanceController::class)->group(function () {
                    Route::get('', 'index')->name('attendances.index');
                    Route::get('create', 'createOrEdit')->name('attendances.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('attendances.edit');
                    Route::post('store', 'store')->name('attendances.store');
                    Route::put('update/{id}', 'update')->name('attendances.update');
                    Route::delete('delete/{id}', 'destroy')->name('attendances.destroy');

                    Route::get('create-or-edit-multiple', 'createOrEditMultiple')->name('attendances.create-or-edit-multiple');
                    Route::post('storeOrUpdate-multiple', 'storeOrUpdateMultiple')->name('attendances.storeOrUpdate-multiple');
                    Route::post('attendance-by-date', 'attendanceByDate')->name('attendances.by-date');
                });
                Route::prefix('attendance-processes')->controller(AttendanceProcessController::class)->group(function () {
                    Route::match(['get', 'post'], '', 'index')->name('attendance-processes.index');
                    Route::post('proccess', 'proccess')->name('attendance-processes.proccess');
                });
                Route::prefix('reports')->controller(AttendanceController::class)->group(function () {
                    Route::match(['get', 'post'], '', 'reportIndex')->name('attendances-reports.index');
                });
            });
            Route::prefix('leaves')->group(function () {
                Route::prefix('leaves')->controller(LeaveController::class)->group(function () {
                    Route::get('', 'index')->name('leaves.index');
                    Route::get('create', 'createOrEdit')->name('leaves.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('leaves.edit');
                    Route::post('store', 'store')->name('leaves.store');
                    Route::put('update/{id}', 'update')->name('leaves.update');
                    Route::delete('delete/{id}', 'destroy')->name('leaves.destroy');
                });
                Route::prefix('reports')->controller(LeaveController::class)->group(function () {
                    Route::match(['get', 'post'], '', 'reportIndex')->name('leave-reports.index');
                });
            });

            Route::prefix('loans')->group(function () {
                Route::prefix('loans')->controller(LoanController::class)->group(function () {
                    Route::get('', 'index')->name('loans.index');
                    Route::get('create', 'createOrEdit')->name('loans.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('loans.edit');
                    Route::post('store', 'store')->name('loans.store');
                    Route::put('update/{id}', 'update')->name('loans.update');
                    Route::delete('delete/{id}', 'destroy')->name('loans.destroy');
                });
                Route::prefix('loan-processes')->controller(LoanController::class)->group(function () {
                    Route::match(['get', 'post'], '', 'loanIndex')->name('loan-processes.index');
                    Route::post('proccess', 'loanProcess')->name('loan-processes.proccess');
                });
            });
            Route::prefix('payrolls')->group(function () {
                Route::prefix('salary-processes')->controller(SalaryProcessController::class)->group(function () {
                    Route::match(['get', 'post'], '', 'index')->name('salary-processes.index');
                    Route::post('is-attendance-processed', 'isAttendanceProcessed')->name('salary-processes.isAttendanceProcessed');
                    Route::post('is-loan-processed', 'isLoanProcessed')->name('salary-processes.isLoanProcessed');
                    Route::get('proccess', 'proccess')->name('salary-processes.process');
                });
                Route::prefix('salaries')->controller(SalaryController::class)->group(function () {
                    Route::match(['get', 'post'], '', 'index')->name('salaries.index');
                    Route::post('store', 'store')->name('salaries.store');
                });
            });
        });
    });


    //Inventory Module Routes
    route::namespace('App\Http\Controllers\admin')->group(function () {
        Route::prefix('inventory')->middleware('admin')->group(function () {
            Route::prefix('setup')->group(function () {
                Route::prefix('recipes')->controller(RecipeController::class)->group(function () {
                    Route::get('', 'index')->name('recipes.index');
                    Route::get('create', 'createOrEdit')->name('recipes.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('recipes.edit');
                    Route::post('store', 'store')->name('recipes.store');
                    Route::put('update/{id}', 'update')->name('recipes.update');
                    Route::get('load-units/{unit_type}', 'loadUnit')->name('recipes.load-units');
                    Route::get('vouchar/{id}/{print}', 'vouchar')->name('recipes.vouchar.print');
                    Route::delete('delete/{id}', 'destroy')->name('recipes.destroy');
                });

                Route::prefix('suppliers')->controller(SupplierController::class)->group(function () {
                    Route::get('', 'index')->name('suppliers.index');
                    Route::post('store', 'store')->name('suppliers.store');
                    Route::put('update/{id}', 'update')->name('suppliers.update');
                    Route::get('create', 'createOrEdit')->name('suppliers.create');
                    Route::get('edit/{id?}', 'createOrEdit')->name('suppliers.edit');
                    Route::delete('delete/{id}', 'destroy')->name('suppliers.destroy');
                });
            });
            // Route::prefix('purchases')->controller(PurchaseController::class)->group(function () {
            //     Route::get('', 'index')->name('purchases.index');
            //     Route::post('store', 'store')->name('purchases.store');
            //     Route::get('create', 'createOrEdit')->name('purchases.create');
            //     Route::get('vouchar/{id}', 'vouchar')->name('purchases.vouchar');
            //     Route::get('vouchar/{id}/{print}', 'vouchar')->name('purchases.vouchar.print');
            //     Route::post('payment/store', 'payment')->name('purchases.payment.store');
            //     Route::delete('payment/destroy', 'destroy')->name('purchases.payment.destroy');
            //     Route::get('purchase-requisition/{vouchar_no}', 'purchaseRequisition')->name('purchase-orders.purchase-requisition');
            // });
            Route::prefix('payments')->controller(PaymentController::class)->group(function () {
                Route::get('', 'index')->name('payments.index');
                Route::get('create', 'createOrEdit')->name('payments.create');
                Route::post('store', 'store')->name('payments.store');
                Route::post('due/vouchars', 'dueVouchars')->name('payments.due.vouchars');
            });
            Route::prefix('issue-items')->controller(IssueItemController::class)->group(function () {
                Route::get('', 'index')->name('issue-items.index');
                Route::post('store', 'store')->name('issue-items.store');
                Route::get('create', 'createOrEdit')->name('issue-items.create');
                Route::get('invoice/{id}', 'invoice')->name('issue-items.invoice');
                Route::get('invoice/{id}/{print}', 'invoice')->name('issue-items.invoice.print');
            });
            Route::prefix('production-plans')->controller(ProductionPlanController::class)->group(function () {
                Route::get('', 'index')->name('production-plans.index');
                Route::get('create', 'createOrEdit')->name('production-plans.create');
                Route::get('edit/{id?}', 'createOrEdit')->name('production-plans.edit');
                Route::post('store', 'store')->name('production-plans.store');
                Route::put('update/{id}', 'update')->name('production-plans.update');
                Route::delete('delete/{id}', 'destroy')->name('production-plans.destroy');
                Route::get('view/{id}', 'view')->name('production-plans.vouchar.view');
            });
            Route::prefix('purchase-requisitions')->controller(PurchaseRequisitionController::class)->group(function () {
                Route::get('', 'index')->name('purchase-requisitions.index');
                Route::post('store', 'store')->name('purchase-requisitions.store');
                Route::put('update/{id}', 'update')->name('purchase-requisitions.update');
                Route::get('create', 'createOrEdit')->name('purchase-requisitions.create');
                Route::get('edit/{id}', 'createOrEdit')->name('purchase-requisitions.edit');
                Route::get('vouchar/{id}', 'vouchar')->name('purchase-requisitions.vouchar');
                Route::get('vouchar/{id}/{print}', 'vouchar')->name('purchase-requisitions.vouchar.print');
                Route::delete('delete/{id}', 'destroy')->name('purchase-requisitions.destroy');
                Route::get('production-plans/{date}', 'productionPlans')->name('purchase-requisitions.production-plan');
            });
        });
    });



    //Expense Module Routes
    route::namespace('App\Http\Controllers\admin\expense')->group(function () {
        Route::prefix('expense')->middleware('admin')->group(function () {
            Route::prefix('expense-categories')->controller(ExpenseCategoryController::class)->group(function () {
                Route::get('', 'index')->name('expense-categories.index');
                Route::get('create', 'createOrEdit')->name('expense-categories.create');
                Route::get('edit/{id?}', 'createOrEdit')->name('expense-categories.edit');
                Route::post('store', 'store')->name('expense-categories.store');
                Route::put('update/{id}', 'update')->name('expense-categories.update');
                Route::delete('delete/{id}', 'destroy')->name('expense-categories.destroy');
            });
            Route::prefix('expense-heads')->controller(ExpenseHeadController::class)->group(function () {
                Route::get('', 'index')->name('expense-heads.index');
                Route::get('create', 'createOrEdit')->name('expense-heads.create');
                Route::get('edit/{id?}', 'createOrEdit')->name('expense-heads.edit');
                Route::post('store', 'store')->name('expense-heads.store');
                Route::put('update/{id}', 'update')->name('expense-heads.update');
                Route::delete('delete/{id}', 'destroy')->name('expense-heads.destroy');
            });
            Route::prefix('expenses')->controller(ExpenseController::class)->group(function () {
                Route::get('', 'index')->name('expenses.index');
                Route::get('create', 'createOrEdit')->name('expenses.create');
                Route::get('edit/{id?}', 'createOrEdit')->name('expenses.edit');
                Route::post('store', 'store')->name('expenses.store');
                Route::put('update/{id}', 'update')->name('expenses.update');
                Route::post('details', 'details')->name('expenses.details');
                Route::delete('delete/{id}', 'destroy')->name('expenses.destroy');
                Route::match(['get', 'post'], 'report', 'report')->name('expenses.report');
            });
            Route::prefix('reports')->controller(ExpenseController::class)->group(function () {
                Route::match(['get', 'post'], '', 'reports')->name('expenses.reports');
            });
        });
    });
});


require __DIR__ . '/auth.php';
