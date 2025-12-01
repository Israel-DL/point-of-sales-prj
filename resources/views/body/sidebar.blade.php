<div class="left-side-menu">

                <div class="h-100" data-simplebar>

                    <!-- User box -->
                    

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title">Navigation</li>

                            <li>
                                <a href="{{ url('/dashboard') }}">
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                            @if (Auth::user()->can('pos.menu'))
                            <li>
                                <a href="{{ route('pos') }}">
                                    <span class="badge bg-pink float-end">New</span>
                                    <i class="mdi mdi-cash-register"></i>
                                    <span> POS </span>
                                </a>
                            </li>
                            @endif
                            

                            <li class="menu-title mt-2">Menu</li>

                            

                            
                            @if (Auth::user()->can('employee.menu'))
                            <li>
                                <a href="#sidebarEmployees" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-tie"></i>
                                    <span> Manage Employee  </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEmployees">
                                    <ul class="nav-second-level">
                                        @if (Auth::user()->can('employee.all'))
                                        <li>
                                            <a href="{{ route('all.employee') }}">All Employees</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('employee.add'))
                                        <li>
                                            <a href="{{ route('add.employee') }}">Add Employee</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::user()->can('customer.menu'))
                            <li>
                                <a href="#sidebarCustomers" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-multiple-outline"></i>
                                    <span> Manage Customers </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCustomers">
                                    <ul class="nav-second-level">
                                        @if (Auth::user()->can('customer.all'))
                                        <li>
                                            <a href="{{ route('all.customer') }}">All Customers</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('customer.add'))
                                        <li>
                                            <a href="{{ route('add.customer') }}">Add Customer</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::user()->can('supplier.menu'))
                            <li>
                                <a href="#sidebarSuppliers" data-bs-toggle="collapse">
                                    <i class="mdi mdi-truck-delivery-outline"></i>
                                    <span> Manage Suppliers </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSuppliers">
                                    <ul class="nav-second-level">
                                        @if (Auth::user()->can('supplier.all'))
                                        <li>
                                            <a href="{{ route('all.supplier') }}">All Suppliers</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('supplier.add'))
                                        <li>
                                            <a href="{{ route('add.supplier') }}">Add Supplier</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::user()->can('salary.menu'))
                            <li>
                                <a href="#sidebarSalary" data-bs-toggle="collapse">
                                    <i class=" mdi mdi-cash-usd-outline"></i>
                                    <span>Manage Emp-Salary </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSalary">
                                    <ul class="nav-second-level">
                                        @if (Auth::user()->can('salary.add'))
                                        <li>
                                            <a href="{{ route('add.advance.salary') }}">Add Advance Salary</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('salary.all'))
                                        <li>
                                            <a href="{{ route('all.advance.salary') }}">All Advance Salary</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('salary.pay'))
                                        <li>
                                            <a href="{{ route('pay.salary') }}">Pay Salary</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('salary.month'))
                                        <li>
                                            <a href="{{ route('month.salary') }}">Last Month Salary</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::user()->can('attendance.menu'))
                            <li>
                                <a href="#attendance" data-bs-toggle="collapse">
                                    <i class=" mdi mdi-calendar-check"></i>
                                    <span> Manage Attendance </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="attendance">
                                    <ul class="nav-second-level">
                                        @if (Auth::user()->can('attendance.list'))
                                        <li>
                                            <a href="{{ route('employee.attendance.list') }}">Employee Attendance List</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::user()->can('category.menu'))
                            <li>
                                <a href="#prodcutCategory" data-bs-toggle="collapse">
                                    <i class=" mdi mdi-folder-heart"></i>
                                    <span> Manage Category </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="prodcutCategory">
                                    <ul class="nav-second-level">
                                        @if (Auth::user()->can('category.all'))
                                        <li>
                                            <a href="{{ route('all.product.category') }}">All Product Category</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::user()->can('product.menu'))
                            <li>
                                <a href="#manageProducts" data-bs-toggle="collapse">
                                    <i class=" mdi mdi-cart-outline"></i>
                                    <span> Manage Products </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="manageProducts">
                                    <ul class="nav-second-level">
                                        @if (Auth::user()->can('product.all'))
                                        <li>
                                            <a href="{{ route('all.product') }}">All Products</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('product.add'))
                                        <li>
                                            <a href="{{ route('add.product') }}">Add Products</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('product.import'))
                                        <li>
                                            <a href="{{ route('import.product') }}">Import Products</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::user()->can('expense.menu'))
                            <li>
                                <a href="#manageExpense" data-bs-toggle="collapse">
                                    <i class=" mdi mdi-cash"></i>
                                    <span> Manage Expenses </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="manageExpense">
                                    <ul class="nav-second-level">
                                        @if (Auth::user()->can('expense.add'))
                                        <li>
                                            <a href="{{ route('add.expense') }}">Add Expense</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('expense.today'))
                                        <li>
                                            <a href="{{ route('today.expense') }}">Today's Expense</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('expense.month'))
                                        <li>
                                            <a href="{{ route('month.expense') }}">Monthly Expense</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('expense.year'))
                                        <li>
                                            <a href="{{ route('year.expense') }}">Yearly Expense</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::user()->can('orders.menu'))
                            <li>
                                <a href="#manageInvoices" data-bs-toggle="collapse">
                                    <i class="mdi mdi-file-document-multiple"></i>
                                    <span> Manage Orders </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="manageInvoices">
                                    <ul class="nav-second-level">
                                        @if (Auth::user()->can('orders.pending'))
                                        <li>
                                            <a href="{{ route('pending.order') }}">Pending Orders</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('orders.complete'))
                                        <li>
                                            <a href="{{ route('completed.order') }}">Completed Orders</a>
                                        </li> 
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::user()->can('stock.menu'))
                            <li>
                                <a href="#manageStocks" data-bs-toggle="collapse">
                                    <i class="mdi mdi-package-variant"></i>
                                    <span> Manage Stocks </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="manageStocks">
                                    <ul class="nav-second-level">
                                        @if (Auth::user()->can('stock.all'))
                                        <li>
                                            <a href="{{ route('manage.stocks') }}">Stocks</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::user()->can('roles.menu'))
                            <li>
                                <a href="#manageRPS" data-bs-toggle="collapse">
                                    <i class="mdi mdi-shield-account-variant"></i>
                                    <span> Roles and Permissions </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="manageRPS">
                                    <ul class="nav-second-level">
                                        @if (Auth::user()->can('roles.permission.all'))
                                        <li>
                                            <a href="{{ route('all.permission') }}">All Permission</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('roles.all'))
                                        <li>
                                            <a href="{{ route('all.roles') }}">All Roles</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('roles.in.permission.add'))
                                        <li>
                                            <a href="{{ route('add.roles.permission') }}">Add Roles in Permission</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('roles.in.permission.all'))
                                        <li>
                                            <a href="{{ route('all.roles.permission') }}">All Roles in Permission</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if (Auth::user()->can('admin.menu'))
                            <li>
                                <a href="#admin" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-switch"></i>
                                    <span> Admin User Role Settings </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="admin">
                                    <ul class="nav-second-level">
                                        @if (Auth::user()->can('admin.all'))
                                        <li>
                                            <a href="{{ route('all.admin') }}">All Admin</a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->can('admin.add'))
                                        <li>
                                            <a href="{{ route('add.admin') }}">Add Admin</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            


                          
                            @if (Auth::user()->can('database.menu'))
                            <li class="menu-title mt-2">Database</li>

                            <li>
                                <a href="#backup" data-bs-toggle="collapse">
                                    <i class="mdi mdi-database-arrow-down"></i>
                                    <span> Database Backup </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="backup">
                                    <ul class="nav-second-level">
                                        @if (Auth::user()->can('database.backup'))
                                        <li>
                                            <a href="{{ route('database.backup') }}">Backup Database</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @endif

                            

                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>