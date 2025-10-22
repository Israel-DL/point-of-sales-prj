<?php

use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ExpenseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');

Route::get('/logout', [AdminController::class, 'AdminLogoutPage'])->name('admin.logout.page');

Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/store/profile', [AdminController::class, 'AdminStoreProfile'])->name('admin.store.profile');  
    Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change.password');
    Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update.password');

    Route::controller(EmployeeController::class)->group(function(){
        Route::get('/all/employee', 'AllEmployee')->name('all.employee'); 
        Route::get('/add/employee', 'AddEmployee')->name('add.employee');
        Route::post('/store/employee', 'StoreEmployee')->name('employee.store'); 
        Route::get('/edit/employee/{id}', 'EditEmployee')->name('edit.employee');
        Route::post('/update/employee', 'UpdateEmployee')->name('employee.update');
        Route::get('/delete/employee/{id}', 'DeleteEmployee')->name('delete.employee');
    });

    Route::controller(CustomerController::class)->group(function(){
        Route::get('/all/customer', 'AllCustomer')->name('all.customer'); 
        Route::get('/add/customer', 'AddCustomer')->name('add.customer');  
        Route::post('/store/customer', 'CustomerStore')->name('customer.store');
        Route::get('/edit/customer/{id}', 'EditCustomer')->name('edit.customer');  
        Route::post('/update/customer', 'UpdateCustomer')->name('customer.update'); 
        Route::get('/delete/customer/{id}', 'DeleteCustomer')->name('delete.customer');
    });

    Route::controller(SupplierController::class)->group(function(){
        Route::get('/all/supplier', 'AllSupplier')->name('all.supplier');
        Route::get('/add/supplier', 'AddSupplier')->name('add.supplier'); 
        Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
        Route::get('/edit/supplier/{id}', 'EditSupplier')->name('edit.supplier'); 
        Route::post('/update/supplier', 'UpdateSupplier')->name('supplier.update');
        Route::get('/delete/supplier/{id}', 'DeletesSupplier')->name('delete.supplier');
        Route::get('/supplier/details/{id}', 'DetailsSupplier')->name('details.supplier');
    });

    Route::controller(SalaryController::class)->group(function(){
        Route::get('/add/advance/salary', 'AddAdvanceSalary')->name('add.advance.salary');
        Route::get('/all/advance/salary', 'AllAdvanceSalary')->name('all.advance.salary');  
        Route::post('/advance/salary/store', 'AdvanceSalaryStore')->name('advance.salary.store');
        Route::get('/edit/advance/salary/{id}', 'EditAdvanceSalary')->name('edit.advance.salary');
        Route::post('/update/advance/salary', 'AdvanceSalaryUpdate')->name('advance.salary.update');
        Route::get('/delete/advance/salary/{id}', 'DeleteAdvanceSalary')->name('delete.advance.salary');
    });

    Route::controller(SalaryController::class)->group(function(){
        Route::get('/pay/salary', 'PaySalary')->name('pay.salary');
        Route::get('/pay/salary/now/{id}', 'PaySalaryNow')->name('pay.salary.now');
        Route::post('/employee/salary/store', 'EmployeeSalaryStore')->name('employee.salary.store');
        Route::get('/month/salary', 'MonthSalary')->name('month.salary');
    });

    Route::controller(AttendanceController::class)->group(function(){
        Route::get('/employee/attendance/list', 'EmployeeAttendanceList')->name('employee.attendance.list');
        Route::get('/add/employee/attendance', 'AddEmployeeAttendance')->name('add.employee.attendance');
        Route::post('/employee/attendance/store', 'EmployeeAttendanceStore')->name('employee.attendance.store');
        Route::get('/edit/employee/attendance/{date}', 'EditEmployeeAttendance')->name('employee.attendance.edit');
        Route::get('/view/employee/attendance/{date}', 'ViewEmployeeAttendance')->name('employee.attendance.view');
    });

    Route::controller(ProductCategoryController::class)->group(function(){
        Route::get('/all/product/category', 'AllProductCategory')->name('all.product.category'); 
        Route::post('/store/product/category', 'StoreProductCategory')->name('product.category.store');
        Route::get('/edit/product/category/{id}', 'EditProductCategory')->name('edit.product.category');
        Route::post('/update/product/category', 'UpdateProductCategory')->name('update.product.category'); 
        Route::get('/delete/product/category/{id}', 'DeleteProductCategory')->name('delete.product.category');
    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('product.store'); 
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::post('/update/product', 'UpdateProduct')->name('product.update');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');

        Route::get('/barcode/product/{id}', 'BarcodeProduct')->name('barcode.product');

        Route::get('/import/product', 'ImportProduct')->name('import.product');
        Route::get('/export', 'Export')->name('export');
        Route::post('/import', 'Import')->name('import');
    });

    Route::controller(ExpenseController::class)->group(function(){
        Route::get('/add/expense', 'AddExpense')->name('add.expense');
        Route::post('/store/expense', 'StoreExpense')->name('expense.store');
        Route::get('/today/expense', 'TodayExpense')->name('today.expense');
        Route::get('/edit/expense/{id}', 'EditExpense')->name('edit.expense');
        Route::post('/expense/update', 'UpdateExpense')->name('expense.update');
        Route::get('/month/expense', 'MonthExpense')->name('month.expense');
        Route::get('/year/expense', 'YearExpense')->name('year.expense');
    });

});


