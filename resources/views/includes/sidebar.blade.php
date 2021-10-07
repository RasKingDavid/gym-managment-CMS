   <li class="nav-dropdown {{ Utilities::setActiveMenu('dashboard*',true) }}">
                    <a href="#">
                        <i class="ion-home"></i> <span>Dashboard</span>
                    </a>
                     <ul>
                        <li class="{{ Utilities::setActiveMenu('dashboard') }}"><a href="{{ action('DashboardController@index') }}">Dashboard Members</a></li>
                        @permission(['manage-gymie','manage-enquiries','add-enquiry'])
                        <li class="{{ Utilities::setActiveMenu('dashboard/charts') }}"><a href="{{ action('DashboardController@indexCharts') }}">Dashboard Charts</a></li>
                        @endpermission
                    </ul>
                </li>
                
                @permission(['manage-gymie','manage-enquiries','view-enquiry'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('enquiries*',true) }}">
                    <a href="#">
                        <i class="ion-ios-telephone"></i> <span>Enquiries</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('enquiries/all') }}"><a href="{{ action('EnquiriesController@index') }}">All Enquiries</a></li>
                        @permission(['manage-gymie','manage-enquiries','add-enquiry'])
                        <li class="{{ Utilities::setActiveMenu('enquiries/create') }}"><a href="{{ action('EnquiriesController@create') }}">Add Enquiry</a></li>
                        @endpermission
                        <li class="{{ Utilities::setActiveMenu('enquiries/all') }}"><a href="{{ route('website-enquiries.index') }}">Website Enquiries</a></li>
                    </ul>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-members','view-member'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('members*',true) }}">
                    <a href="#">
                        <i class="ion-person-add"></i> <span>Members</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('members/all') }}"><a href="{{ action('MembersController@index') }}">All Members</a></li>
                        @permission(['manage-gymie','manage-members','add-member'])
                        <li class="{{ Utilities::setActiveMenu('members/create') }}"><a href="{{ action('MembersController@create') }}">Add Member</a></li>
                        @endpermission
                        <li class="{{ Utilities::setActiveMenu('members/active') }}"><a href="{{ action('MembersController@active') }}">Active Members</a></li>
                        <li class="{{ Utilities::setActiveMenu('members/inactive') }}"><a href="{{ action('MembersController@inactive') }}">Inactive Members</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('working-schedule.index') }}">
                        <i class="ion-ios-time"></i> Member Working Schedule
                    </a>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-payments','view-payment'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('payments*',true) }}">
                    <a href="#">
                        <i class="ion-cash"></i> <span>Payments</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('payments/all') }}"><a href="{{ action('PaymentsController@index') }}">All Payments</a></li>
                        @permission(['manage-gymie','manage-payments','add-payment'])
                        <li class="{{ Utilities::setActiveMenu('payments/create') }}"><a href="{{ action('PaymentsController@create') }}">Add Payment</a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-subscriptions','view-subscription'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('subscriptions*',true) }}">
                    <a href="#">
                        <i class="ion-android-checkbox-outline"></i> <span>Subscriptions</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('subscriptions/all') }}"><a href="{{ action('SubscriptionsController@index') }}">All
                                Subscriptions</a></li>
                        @permission(['manage-gymie','manage-subscriptions','add-subscription'])
                        <li class="{{ Utilities::setActiveMenu('subscriptions/create') }}"><a href="{{ action('SubscriptionsController@create') }}">Add
                                Subscription</a></li>
                        @endpermission
                        <li class="{{ Utilities::setActiveMenu('subscriptions/expiring') }}"><a href="{{ action('SubscriptionsController@expiring') }}">Expiring
                                Subscriptions</a></li>
                        <li class="{{ Utilities::setActiveMenu('subscriptions/expired') }}"><a href="{{ action('SubscriptionsController@expired') }}">Expired
                                Subscriptions</a></li>
                    </ul>
                </li>
                @endpermission

            <!-- <li class="nav-dropdown {{-- Utilities::setActiveMenu('reports*',true) --}}">
                            <a href="#">
                                <i class="fa fa-file"></i> <span>Reports</span>
                            </a>
                            <ul>
                                <li class="{{-- Utilities::setActiveMenu('reports/members/*') --}}"><a href="{{-- action('ReportsController@gymMemberCharts') --}}">Members</a></li>
                                <li class="{{-- Utilities::setActiveMenu('reports/enquiries/*') --}}"><a href="{{-- action('ReportsController@enquiryCharts') --}}">Enquiries</a></li>
                                <li class="{{-- Utilities::setActiveMenu('reports/subscriptions/*') --}}"><a href="{{-- action('ReportsController@subscriptionCharts') --}}">Subscriptions</a></li>
                                <li class="{{-- Utilities::setActiveMenu('reports/payments/*') --}}"><a href="{{-- action('ReportsController@paymentCharts') --}}">Payments</a></li>                            
                                <li class="{{-- Utilities::setActiveMenu('reports/expenses/*') --}}"><a href="{{-- action('ReportsController@expenseCharts') --}}">Expenses</a></li>                            
                                <li class="{{-- Utilities::setActiveMenu('reports/invoices/*') --}}"><a href="{{-- action('ReportsController@invoiceCharts') --}}">Invoices</a></li>                            
                            </ul>
                        </li> -->

                @permission(['manage-gymie','manage-sms'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('sms*',true) }}">
                    <a href="#">
                        <i class="ion-ios-email"></i> <span>EMAIL</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('sms/triggers') }}"><a href="{{ action('SmsController@triggersIndex') }}">Triggers</a></li>
                        <li class="{{ Utilities::setActiveMenu('sms/events') }}"><a href="{{ action('SmsController@eventsIndex') }}">Schedule message</a></li>
                        <li class="{{ Utilities::setActiveMenu('sms/send') }}"><a href="{{ action('SmsController@send') }}">Send message</a></li>
                        <li class="{{ Utilities::setActiveMenu('sms/log') }}"><a href="{{ action('SmsController@logIndex') }}">Log</a></li>
                    </ul>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-invoices','view-invoice','manage-pos'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('invoices*',true) }}">
                    <a href="#">
                        <i class="ion-ios-paper"></i> <span>Invoices</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('invoices/all') }}"><a href="{{ action('InvoicesController@index') }}">All Invoices</a></li>
                        <li class="{{ Utilities::setActiveMenu('invoices/paid') }}"><a href="{{ action('InvoicesController@paid') }}">Paid Invoices</a></li>
                        <li class="{{ Utilities::setActiveMenu('invoices/unpaid') }}"><a href="{{ action('InvoicesController@unpaid') }}">Unpaid Invoices</a>
                        </li>
                        <li class="{{ Utilities::setActiveMenu('invoices/partial') }}"><a href="{{ action('InvoicesController@partial') }}">Partial Invoices</a>
                        </li>
                        <li class="{{ Utilities::setActiveMenu('invoices/overpaid') }}"><a href="{{ action('InvoicesController@overpaid') }}">Overpaid
                                Invoices</a></li>
                        <li class="{{ Utilities::setActiveMenu('pos-invoices') }}"><a href="{{ route('pos.index') }}">POS Invoices</a></li>
                        <li class="{{ Utilities::setActiveMenu('new.orders') }}"><a href="{{ route('new.orders') }}">Shop Invoices</a></li>
                    </ul>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-expenses','view-expense'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('expenses*',true) }}">
                    <a href="#">
                        <i class="ion-social-usd"></i><span> Expenses</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('expenses/all') }}"><a href="{{ action('ExpensesController@index') }}">All Expenses</a></li>
                        @permission(['manage-gymie','manage-expenses','add-expense'])
                        <li class="{{ Utilities::setActiveMenu('expenses/create') }}"><a href="{{ action('ExpensesController@create') }}">Add Expense</a></li>
                        @endpermission
                        @permission(['manage-gymie','manage-expenseCategories','view-expenseCategory'])
                        <li class="{{ Utilities::setActiveMenu('expenses/categories/all') }}"><a href="{{ action('ExpenseCategoriesController@index') }}">Expense
                                Categories</a></li>
                        @endpermission
                        @permission(['manage-gymie','manage-expenseCategories','add-expenseCategory'])
                        <li class="{{ Utilities::setActiveMenu('expenses/categories/create') }}"><a href="{{ action('ExpenseCategoriesController@create') }}">Add
                                Category</a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission

                @permission(['manage-gymie','manage-plans','view-plan'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('plans*',true) }}">
                    <a href="#">
                        <i class="ion-compose"></i> <span>Plans</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('plans/all') }}"><a href="{{ action('PlansController@index') }}">All Plans</a></li>
                        @permission(['manage-gymie','manage-plans','add-plan'])
                        <li class="{{ Utilities::setActiveMenu('plans/create') }}"><a href="{{ action('PlansController@create') }}">Add Plan</a></li>
                        @endpermission
                        @permission(['manage-gymie','manage-services','view-service'])
                        <li class="{{ Utilities::setActiveMenu('plans/services/all') }}"><a href="{{ action('ServicesController@index') }}">Gym Services</a>
                        </li>
                        @endpermission
                        @permission(['manage-gymie','manage-services','add-service'])
                        <li class="{{ Utilities::setActiveMenu('plans/services/create') }}"><a href="{{ action('ServicesController@create') }}">Add Service</a>
                        </li>
                        @endpermission
                    </ul>
                </li>
                @endpermission
                
                @permission(['manage-gymie','manage-users'])
                <li class="nav-dropdown {{ Utilities::setActiveMenu('user*',true) }}">
                    <a href="#">
                        <i class="ion-ios-people"></i> <span>Users</span>
                    </a>
                    <ul>
                        <li class="{{ Utilities::setActiveMenu('user') }}"><a href="{{ action('AclController@userIndex') }}"><i class="fa fa-upload"></i> All
                                Users</a></li>
                        <li class="{{ Utilities::setActiveMenu('user/create') }}"><a href="{{ action('AclController@createUser') }}"><i class="fa fa-list"></i>
                                Add new user</a></li>
                        <li class="{{ Utilities::setActiveMenu('user/role') }}"><a href="{{ action('AclController@roleIndex') }}"><i class="fa fa-list"></i>
                                Roles</a></li>
                        @role('Gymie')
                        <li class="{{ Utilities::setActiveMenu('user/permission') }}"><a href="{{ action('AclController@permissionIndex') }}"><i
                                        class="fa fa-list"></i> Permissions</a></li>
                        @endrole
                    </ul>
                </li>
                @endpermission
                <li>
                    <a href="{{ route('category.index') }}"><i class="ion-android-list"></i> Categories</a>
                    <a href="{{ route('product.index') }}"><i class="ion-ios-box"></i> Products</a>
                    <a href="{{ route('pos.create') }}"><i class="ion-android-cart"></i> POS System</a>
                </li>
                @permission(['manage-gymie','manage-settings'])
                <li class="{{ Utilities::setActiveMenu('settings*') }}">
                    <a href="{{ action('SettingsController@edit') }}">
                        <i class="fa fa-cogs fa-2x"></i> <span>Settings</span>
                    </a>
                </li>
                @endpermission
