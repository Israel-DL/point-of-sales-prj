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
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\RoleController;

Route::get('/', function () {
    return redirect('/login');
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
        Route::get('/all/employee', 'AllEmployee')->name('all.employee')->middleware('permission:employee.all'); 
        Route::get('/add/employee', 'AddEmployee')->name('add.employee')->middleware('permission:employee.add');
        Route::post('/store/employee', 'StoreEmployee')->name('employee.store'); 
        Route::get('/edit/employee/{id}', 'EditEmployee')->name('edit.employee')->middleware('permission:employee.edit');
        Route::post('/update/employee', 'UpdateEmployee')->name('employee.update');
        Route::get('/delete/employee/{id}', 'DeleteEmployee')->name('delete.employee')->middleware('permission:employee.delete');
    });

    Route::controller(CustomerController::class)->group(function(){
        Route::get('/all/customer', 'AllCustomer')->name('all.customer')->middleware('permission:customer.all');
        Route::get('/add/customer', 'AddCustomer')->name('add.customer')->middleware('permission:customer.add');  
        Route::post('/store/customer', 'CustomerStore')->name('customer.store');
        Route::get('/edit/customer/{id}', 'EditCustomer')->name('edit.customer')->middleware('permission:customer.edit');
        Route::post('/update/customer', 'UpdateCustomer')->name('customer.update'); 
        Route::get('/delete/customer/{id}', 'DeleteCustomer')->name('delete.customer')->middleware('permission:customer.delete');
    });

    Route::controller(SupplierController::class)->group(function(){
        Route::get('/all/supplier', 'AllSupplier')->name('all.supplier')->middleware('permission:supplier.all');
        Route::get('/add/supplier', 'AddSupplier')->name('add.supplier')->middleware('permission:supplier.add');
        Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
        Route::get('/edit/supplier/{id}', 'EditSupplier')->name('edit.supplier')->middleware('permission:supplier.edit');
        Route::post('/update/supplier', 'UpdateSupplier')->name('supplier.update');
        Route::get('/delete/supplier/{id}', 'DeletesSupplier')->name('delete.supplier')->middleware('permission:supplier.delete');
        Route::get('/supplier/details/{id}', 'DetailsSupplier')->name('details.supplier');
    });

    Route::controller(SalaryController::class)->group(function(){
        Route::get('/add/advance/salary', 'AddAdvanceSalary')->name('add.advance.salary')->middleware('permission:salary.add');
        Route::get('/all/advance/salary', 'AllAdvanceSalary')->name('all.advance.salary')->middleware('permission:salary.all');  
        Route::post('/advance/salary/store', 'AdvanceSalaryStore')->name('advance.salary.store');
        Route::get('/edit/advance/salary/{id}', 'EditAdvanceSalary')->name('edit.advance.salary')->middleware('permission:salary.edit');
        Route::post('/update/advance/salary', 'AdvanceSalaryUpdate')->name('advance.salary.update');
        Route::get('/delete/advance/salary/{id}', 'DeleteAdvanceSalary')->name('delete.advance.salary')->middleware('permission:salary.delete');
    });

    Route::controller(SalaryController::class)->group(function(){
        Route::get('/pay/salary', 'PaySalary')->name('pay.salary')->middleware('permission:salary.pay');
        Route::get('/pay/salary/now/{id}', 'PaySalaryNow')->name('pay.salary.now')->middleware('permission:salary.pay.now');
        Route::post('/employee/salary/store', 'EmployeeSalaryStore')->name('employee.salary.store');
        Route::get('/month/salary', 'MonthSalary')->name('month.salary')->middleware('permission:salary.month');
    });

    Route::controller(AttendanceController::class)->group(function(){
        Route::get('/employee/attendance/list', 'EmployeeAttendanceList')->name('employee.attendance.list')->middleware('permission:attendance.list');
        Route::get('/add/employee/attendance', 'AddEmployeeAttendance')->name('add.employee.attendance')->middleware('permission:attendance.add');
        Route::post('/employee/attendance/store', 'EmployeeAttendanceStore')->name('employee.attendance.store');
        Route::get('/edit/employee/attendance/{date}', 'EditEmployeeAttendance')->name('employee.attendance.edit')->middleware('permission:attendance.edit');
        Route::get('/view/employee/attendance/{date}', 'ViewEmployeeAttendance')->name('employee.attendance.view');
    });

    Route::controller(ProductCategoryController::class)->group(function(){
        Route::get('/all/product/category', 'AllProductCategory')->name('all.product.category')->middleware('permission:category.all'); 
        Route::post('/store/product/category', 'StoreProductCategory')->name('product.category.store');
        Route::get('/edit/product/category/{id}', 'EditProductCategory')->name('edit.product.category')->middleware('permission:category.edit');
        Route::post('/update/product/category', 'UpdateProductCategory')->name('update.product.category'); 
        Route::get('/delete/product/category/{id}', 'DeleteProductCategory')->name('delete.product.category')->middleware('permission:category.delete');
    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/product', 'AllProduct')->name('all.product')->middleware('permission:product.all');
        Route::get('/add/product', 'AddProduct')->name('add.product')->middleware('permission:product.add');
        Route::post('/store/product', 'StoreProduct')->name('product.store'); 
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product')->middleware('permission:product.edit');
        Route::post('/update/product', 'UpdateProduct')->name('product.update');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product')->middleware('permission:product.delete');

        Route::get('/barcode/product/{id}', 'BarcodeProduct')->name('barcode.product')->middleware('permission:product.barcode');

        Route::get('/import/product', 'ImportProduct')->name('import.product')->middleware('permission:product.import');
        Route::get('/export', 'Export')->name('export')->middleware('permission:product.export');
        Route::post('/import', 'Import')->name('import');
    });

    Route::controller(ExpenseController::class)->group(function(){
        Route::get('/add/expense', 'AddExpense')->name('add.expense')->middleware('permission:expense.add');
        Route::post('/store/expense', 'StoreExpense')->name('expense.store');
        Route::get('/today/expense', 'TodayExpense')->name('today.expense')->middleware('permission:expense.today');
        Route::get('/edit/expense/{id}', 'EditExpense')->name('edit.expense')->middleware('permission:expense.edit');
        Route::post('/expense/update', 'UpdateExpense')->name('expense.update');
        Route::get('/month/expense', 'MonthExpense')->name('month.expense')->middleware('permission:expense.month');
        Route::get('/year/expense', 'YearExpense')->name('year.expense')->middleware('permission:expense.year');
    });

    Route::controller(PosController::class)->group(function(){
        Route::get('/pos', 'Pos')->name('pos')->middleware('permission:pos.new');
        Route::post('/add-cart', 'AddCart');
        Route::get('/allitem', 'AllItem');
        Route::post('/cart-update/{rowId}', 'CartUpdate');
        Route::get('/cart-remove/{rowId}', 'CartRemove');
        Route::post('/create-invoice', 'CreateInvoice');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::post('/final-invoice', 'FinalInvoice');
        Route::get('/pending/order', 'PendingOrder')->name('pending.order')->middleware('permission:orders.pending');
        Route::get('/confirmed/order', 'ConfirmedOrder')->name('confirmed.order')->middleware('permission:orders.confirmed');
        Route::get('/order/details/{order_id}', 'OrderDetails')->name('order.details')->middleware('permission:orders.detail');
        Route::post('/order/status/update', 'OrderStatusUpdate')->name('order.status.update');
        Route::get('/manage/stocks', 'ManageStocks')->name('manage.stocks')->middleware('permission:stock.all');
        Route::get('/order/invoice-download/{order_id}', 'OrderInvoiceDownload')->middleware('permission:orders.pdf.download');

        Route::get('/pending/dueorders', 'PendingDueOrders')->name('pending.due.orders')->middleware('permission:orders.pending.due');
        Route::get('/order/due/{id}', 'OrderDueAjax');
        Route::post('/update/due', 'UpdateDue')->name('update.due');
        Route::get('/completed/dueorders', 'CompletedDueOrders')->name('completed.due.orders')->middleware('permission:orders.completed.due');
    });

    Route::controller(RoleController::class)->group(function(){
        Route::get('/all/permission', 'AllPermission')->name('all.permission')->middleware('permission:roles.permission.all');
        Route::get('/add/permission', 'AddPermission')->name('add.permission')->middleware('permission:roles.permission.add');
        Route::post('/permission/store', 'StorePermission')->name('permission.store');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission')->middleware('permission:roles.permission.edit');
        Route::post('/permission/update', 'UpdatePermission')->name('permission.update');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission')->middleware('permission:roles.permission.delete');
    });

    Route::controller(RoleController::class)->group(function(){
        Route::get('/all/roles', 'AllRoles')->name('all.roles')->middleware('permission:roles.all');
        Route::get('/add/role', 'AddRole')->name('add.role')->middleware('permission:roles.all.add');
        Route::post('/store/role', 'StoreRole')->name('role.store');
        Route::get('/edit/role/{id}', 'EditRole')->name('edit.role')->middleware('permission:roles.all.edit');
        Route::post('/update/role', 'UpdateRole')->name('role.update');
        Route::get('/delete/role/{id}', 'DeleteRole')->name('delete.role')->middleware('permission:roles.all.delete');
    });

    Route::controller(RoleController::class)->group(function(){
        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission')->middleware('permission:roles.in.permission.add');
        Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission')->middleware('permission:roles.in.permission.all');
        Route::get('/edit/role/permission/{id}', 'EditRolesPermission')->name('edit.role.permission')->middleware('permission:roles.in.permission.edit');
        Route::post('/update/role/permission/{id}', 'UpdateRolesPermission')->name('role.permission.update');
        Route::get('/delete/role/permission/{id}', 'DeleteRolesPermission')->name('delete.role.permission')->middleware('permission:roles.in.permission.delete'); 
    });

    Route::controller(AdminController::class)->group(function(){
        Route::get('/all/admin', 'AllAdmin')->name('all.admin')->middleware('permission:admin.all');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin')->middleware('permission:admin.add');
        Route::post('/admin/store', 'StoreAdmin')->name('admin.store');
        Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin')->middleware('permission:admin.edit');
        Route::post('/admin/update', 'UpdateAdmin')->name('admin.update');
        Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin')->middleware('permission:admin.delete');

        Route::get('/database/backup', 'DatabaseBackup')->name('database.backup')->middleware('permission:database.backup');
        Route::get('/backup/now', 'BackupNow')->middleware('permission:database.backup.now');
        Route::get('{getFilename}', 'DownloadDatabase')->middleware('permission:database.download');
        Route::get('/delete/database/{getFilename}', 'DeleteDatabase')->middleware('permission:database.delete');
    });



});


