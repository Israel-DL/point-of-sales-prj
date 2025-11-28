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

                            <li>
                                <a href="{{ route('pos') }}">
                                    <span class="badge bg-pink float-end">New</span>
                                    <i class="mdi mdi-cash-register"></i>
                                    <span> POS </span>
                                </a>
                            </li>
                
                            

                            <li class="menu-title mt-2">Apps</li>

                            

                            

                            <li>
                                <a href="#sidebarEmployees" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-tie"></i>
                                    <span> Manage Employee  </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEmployees">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.employee') }}">All Employees</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.employee') }}">Add Employee</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarCustomers" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-multiple-outline"></i>
                                    <span> Manage Customers </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCustomers">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.customer') }}">All Customers</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.customer') }}">Add Customer</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarSuppliers" data-bs-toggle="collapse">
                                    <i class="mdi mdi-truck-delivery-outline"></i>
                                    <span> Manage Suppliers </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSuppliers">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.supplier') }}">All Suppliers</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.supplier') }}">Add Supplier</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarSalary" data-bs-toggle="collapse">
                                    <i class=" mdi mdi-cash-usd-outline"></i>
                                    <span>Manage Emp-Salary </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSalary">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('add.advance.salary') }}">Add Advance Salary</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('all.advance.salary') }}">All Advance Salary</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('pay.salary') }}">Pay Salary</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('month.salary') }}">Last Month Salary</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#attendance" data-bs-toggle="collapse">
                                    <i class=" mdi mdi-calendar-check"></i>
                                    <span> Manage Attendance </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="attendance">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('employee.attendance.list') }}">Employee Attendance List</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#prodcutCategory" data-bs-toggle="collapse">
                                    <i class=" mdi mdi-folder-heart"></i>
                                    <span> Manage Category </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="prodcutCategory">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.product.category') }}">All Product Category</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#manageProducts" data-bs-toggle="collapse">
                                    <i class=" mdi mdi-cart-outline"></i>
                                    <span> Manage Products </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="manageProducts">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.product') }}">All Products</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('add.product') }}">Add Products</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('import.product') }}">Import Products</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#manageExpense" data-bs-toggle="collapse">
                                    <i class=" mdi mdi-cash"></i>
                                    <span> Manage Expenses </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="manageExpense">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('add.expense') }}">Add Expense</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('today.expense') }}">Today's Expense</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('month.expense') }}">Monthly Expense</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('year.expense') }}">Yearly Expense</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#manageInvoices" data-bs-toggle="collapse">
                                    <i class="mdi mdi-file-document-multiple"></i>
                                    <span> Manage Orders </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="manageInvoices">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('pending.order') }}">Pending Orders</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('completed.order') }}">Completed Orders</a>
                                        </li> 
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#manageStocks" data-bs-toggle="collapse">
                                    <i class="mdi mdi-package-variant"></i>
                                    <span> Manage Stocks </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="manageStocks">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('manage.stocks') }}">Stocks</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#manageRPS" data-bs-toggle="collapse">
                                    <i class="mdi mdi-shield-account-variant"></i>
                                    <span> Roles and Permissions </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="manageRPS">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.permission') }}">All Permission</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('all.roles') }}">All Roles</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.roles.permission') }}">Add Roles in Permission</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('all.roles.permission') }}">All Roles in Permission</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#admin" data-bs-toggle="collapse">
                                    <i class="mdi mdi-shield-account-variant"></i>
                                    <span> Admin User Role Settings </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="admin">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.admin') }}">All Admin</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.admin') }}">Add Admin</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarEmail" data-bs-toggle="collapse">
                                    <i class="mdi mdi-email-multiple-outline"></i>
                                    <span> Email </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEmail">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="email-inbox.html">Inbox</a>
                                        </li>
                                        <li>
                                            <a href="email-read.html">Read Email</a>
                                        </li>
                                        <li>
                                            <a href="email-compose.html">Compose Email</a>
                                        </li>
                                        <li>
                                            <a href="email-templates.html">Email Templates</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                          

                            <li class="menu-title mt-2">Custom</li>

                            <li>
                                <a href="#sidebarAuth" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-circle-outline"></i>
                                    <span> Auth Pages </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarAuth">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="auth-login.html">Log In</a>
                                        </li>
                                        <li>
                                            <a href="auth-login-2.html">Log In 2</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarExpages" data-bs-toggle="collapse">
                                    <i class="mdi mdi-text-box-multiple-outline"></i>
                                    <span> Extra Pages </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarExpages">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="pages-starter.html">Starter</a>
                                        </li>
                                        <li>
                                            <a href="pages-timeline.html">Timeline</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>