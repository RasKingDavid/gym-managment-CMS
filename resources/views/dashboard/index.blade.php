@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            @include('flash::message')
            @permission(['manage-gymie','view-dashboard-quick-stats'])
            <!-- Stat Tile  -->
            <div class="row margin-top-10">
                <div class="container pt-5">
                    <div class="row align-items-stretch">
                        {{-- new orders --}}
                        <div class="col-md-12 alert alert-info text-center " style="margin-top: 5%;margin-bottom:5%">
                            <h4 class="text-success"><i class="fa fa-bell    "></i> You have {{ $newOrders->count() }} new orders</h4>
                            <a href="{{ route('new.orders') }}" class="btn btn-success text-center">view orders</a>
                        </div>
                        <!-- Total Members -->
                    <div class="c-dashboardInfo col-lg-4 col-md-2 col-sm-6 col-xs-12">
                        @include('dashboard._index.totalMembers')
                    </div>

                    <!-- Registrations This Weeks -->
                    <div class="c-dashboardInfo col-lg-4 col-md-2 col-sm-6 col-xs-12">
                        @include('dashboard._index.expiredMembers')
                    </div>

                    <!-- Inactive Members -->
                    <div class="c-dashboardInfo col-lg-3 col-md-2 col-sm-6 col-xs-12">
                        @include('dashboard._index.inActiveMembers')
                    </div>

                    <!-- Members Expired -->
                    <div class="c-dashboardInfo col-lg-4 col-md-2 col-sm-6 col-xs-12">
                        @include('dashboard._index.registeredThisMonth')
                    </div>

                    <!-- Outstanding Payments -->
                    <div class="c-dashboardInfo col-lg-4 col-md-2 col-sm-6 col-xs-12">
                        @include('dashboard._index.outstandingPayments')
                    </div>

                    <!-- Collection Revenue-->
                    <div class="c-dashboardInfo col-lg-3 col-md-2 col-sm-6 col-xs-12">
                         @include('dashboard._index.collection')
                    </div>
                    <!-- Shop Revenue-->
                    <?php
                        $sum = App\PosInvoice::whereMonth('created_at','=',date('m'))->sum('total_amount');
                        $shop_revenue = App\ShopInvoice::whereMonth('created_at','=',date('m'))->sum('total');
                    ?>
                    <div class="c-dashboardInfo col-lg-6 col-md-2 col-sm-6 col-xs-12">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                            <i class="font-size-24 color-green-600 fa fa-usd"></i>
                            </h4><span class="hind-font caption-12 c-dashboardInfo__count">
                                <div class=" font-roboto" data-toggle="counter" data-start="0" data-from="0"
                                    data-to="{{ $sum }}" data-speed="500" data-refresh-interval="10"></div>
                            </span><span
                            class="hind-font caption-12 c-dashboardInfo__subInfo">
                            <a href="{{ route('pos.index') }}">Sales Revenue</a>
                            </span> 
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-lg-6 col-md-2 col-sm-6 col-xs-12">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                            <i class="font-size-24 color-green-600 fa fa-usd"></i>
                            </h4><span class="hind-font caption-12 c-dashboardInfo__count">
                                <div class=" font-roboto" data-toggle="counter" data-start="0" data-from="0"
                                    data-to="{{ $shop_revenue }}" data-speed="500" data-refresh-interval="10"></div>
                            </span><span
                            class="hind-font caption-12 c-dashboardInfo__subInfo">
                            <a href="{{ route('new.orders') }}">Online Revenue</a>
                            </span> 
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                            <i class="font-size-24 color-green-600 fa fa-usd"></i>
                            </h4><span class="hind-font caption-12 c-dashboardInfo__count">
                                <div class=" font-roboto" data-toggle="counter" data-start="0" data-from="0"
                                    data-to="{{ $expirings->count() }}" data-speed="500" data-refresh-interval="10"></div>
                            </span><span
                            class="hind-font caption-12 c-dashboardInfo__subInfo">
                                <a href="{{ url('subscriptions/expiring') }}">Expiring Subscriptions</a>
                            </span> 
                        </div>
                    </div>
                </div>
            </div>
            @endpermission

            <!--Member Quick views -->
            <div class="row"> <!--Main Row-->
                @permission(['manage-gymie','view-dashboard-members-tab'])
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-title">
                            <div class="panel-head"><i class="fa fa-users"></i><a href="{{ action('MembersController@index') }}">Members</a></div>
                            <div class="pull-right"><a href="{{ action('MembersController@create') }}" class="btn-sm btn-primary active" role="button"><i
                                            class="fa fa-user-plus"></i> Add</a></div>
                        </div>

                        <div class="panel-body with-nav-tabs">
                            <!-- Tabs Heads -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#recent" data-toggle="tab">Recent <span class="label label-info margin-left-5">{{ $recentCount }}</span></a></li>
                                 <li><a href="#birthdays" data-toggle="tab">Birthdays<span class="label label-success margin-left-5">{{ $birthdayCount }}</span></a>
                                </li>
                                <li><a href="#expiring" data-toggle="tab">Expiring<span
                                                class="label label-warning margin-left-5">{{ $expiringCount }}</span></a></li>
                                <li><a href="#expired" data-toggle="tab">Expired<span class="label label-danger margin-left-5">{{ $expiredCount }}</span></a>
                                </li>
                               
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="recent">
                                    @include('dashboard._index.recents', ['recents' =>  $recents])
                                </div>

                                 <div class="tab-pane fade" id="birthdays">
                                    @include('dashboard._index.birthdays', ['birthdays' => $birthdays])
                                </div>

                                <div class="tab-pane fade " id="expiring">
                                    @include('dashboard._index.expiring', ['expirings' => $expirings])
                                </div>

                                <div class="tab-pane fade" id="expired">
                                    @include('dashboard._index.expired', ['allExpired' => $allExpired])
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                @endpermission

                @permission(['manage-gymie','view-dashboard-enquiries-tab'])
                <!--Enquiry Quick view Tabs-->
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-title">
                            <div class="panel-head"><i class="fa fa-phone"></i><a href="{{ action('EnquiriesController@index') }}">Enquiries</a></div>
                            <div class="pull-right"><a href="{{ action('EnquiriesController@create') }}" class="btn-sm btn-primary active" role="button"><i
                                            class="fa fa-phone"></i> Add</a></div>
                        </div>

                        <div class="panel-body with-nav-tabs">
                            <!-- Tabs Heads -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#enquiries" data-toggle="tab">Enquiries</a></li>
                                <li><a href="#reminders" data-toggle="tab">Reminders<span class="label label-warning margin-left-5">{{ $reminderCount }}</span></a>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="enquiries">
                                    @include('dashboard._index.enquiries', ['enquiries' => $enquiries])
                                </div>

                                <div class="tab-pane fade" id="reminders">
                                    @include('dashboard._index.reminders', ['reminders' => $reminders])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- stocks --}}
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-title">
                            <div class="panel-head"><i class="fa fa-archive"></i><a href="{{ route('product.index') }}">Minimum Stock Reminder</a></div>
                            <div class="pull-right"><a href="{{ route('product.create') }}" class="btn-sm btn-primary active" role="button"><i
                                            class="fa fa-archive"></i> Add</a></div>
                        </div>

                        <div class="panel-body with-nav-tabs">
                            <!-- Tabs Heads -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#enquiries" data-toggle="tab">Stocks</a></li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="enquiries">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>Product Name</th>
                                            <th>SKU</th>
                                            <th>Current Stock</th>
                                            <th>Minimum Stock</th>
                                        </thead>
                                        @foreach ($products as $item)
                                            @if ($item->stock <= $item->min_stock)
                                                <tr>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>{{ $item->sku }}</td>
                                                    <td>{{ $item->stock }}</td>
                                                    <td>{{ $item->min_stock }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endpermission
            </div> <!--/Main row -->


            @permission(['manage-gymie','view-dashboard-expense-tab'])
            <div class="row">
                <!--Expense Quick view Tabs-->
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-title">
                            <div class="panel-head"><i class="fa fa-usd"></i><a href="{{ action('ExpensesController@index') }}">Expenses</a></div>
                            <div class="pull-right"><a href="{{ action('ExpensesController@create') }}" class="btn-sm btn-primary active" role="button">
                                    <i class="fa fa-usd"></i> Add</a>
                            </div>
                        </div>

                        <div class="panel-body with-nav-tabs">
                            <!-- Tabs Heads -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#due" data-toggle="tab">Due</a></li>
                                <li><a href="#outstanding" data-toggle="tab">Outstanding</a></li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="due">
                                    @include('dashboard._index.due', ['dues' => $dues])
                                </div>

                                <div class="tab-pane fade" id="outstanding">
                                    @include('dashboard._index.outStanding', ['outstandings' => $outstandings])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endpermission

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-title">
                            <div class="panel-head"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>Cheques</div>
                        </div>

                        <div class="panel-body with-nav-tabs">
                            <!-- Tabs Heads -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#recieved" data-toggle="tab">Recieved<span
                                                class="label label-warning margin-left-5">{{ $recievedChequesCount }}</span></a></li>
                                <li><a href="#deposited" data-toggle="tab">Deposited<span
                                                class="label label-primary margin-left-5">{{ $depositedChequesCount }}</span></a></li>
                                <li><a href="#bounced" data-toggle="tab">Bounced<span class="label label-danger margin-left-5">{{ $bouncedChequesCount }}</span></a>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="recieved">
                                    @include('dashboard._index.receivedCheque', ['recievedCheques' =>  $recievedCheques])
                                </div>

                                <div class="tab-pane fade" id="deposited">
                                    @include('dashboard._index.depositedCheques', ['depositedCheques' =>  $depositedCheques])
                                </div>

                                <div class="tab-pane fade" id="bounced">
                                    @include('dashboard._index.bouncedCheques', ['bouncedCheques' =>  $bouncedCheques])
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-title">
                            <div class="panel-head"><i class="fa fa-phone" aria-hidden="true"></i>Mobile Banking</div>
                        </div>

                        <div class="panel-body with-nav-tabs">
                            <!-- Tabs Heads -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#recieved" data-toggle="tab">Recieved<span
                                                class="label label-warning margin-left-5">{{ $recievedChequesCount }}</span></a></li>
                                <li><a href="#deposited" data-toggle="tab">Deposited<span
                                                class="label label-primary margin-left-5">{{ $depositedChequesCount }}</span></a></li>
                                <li><a href="#bounced" data-toggle="tab">Bounced<span class="label label-danger margin-left-5">{{ $bouncedChequesCount }}</span></a>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="recieved">
                                    @include('dashboard._index.receivedCheque', ['recievedCheques' =>  $recievedCheques])
                                </div>

                                <div class="tab-pane fade" id="deposited">
                                    @include('dashboard._index.depositedCheques', ['depositedCheques' =>  $depositedCheques])
                                </div>

                                <div class="tab-pane fade" id="bounced">
                                    @include('dashboard._index.bouncedCheques', ['bouncedCheques' =>  $bouncedCheques])
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

           

            <!-- SMS request confirmation Modal -->
            <div id="smsRequestModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirm request new sms pack</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::Open(['action' => 'DashboardController@smsRequest']) !!}
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        {!! Form::label('smsCount','Select SMS Pack') !!}
                                        {!! Form::select('smsCount',array('5000' => '5000 sms', '10000' => '10000 sms', '15000' => '15000 sms'),null,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'smsCount']) !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-info" value="Submit" id="smsRequest"/>
                            {!! Form::Close() !!}
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@stop

@section('footer_scripts')
    <script src="{{ URL::asset('assets/plugins/morris/raphael-2.1.0.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
@stop

@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            // gymie.loadmorris();
        });
    </script>
@stop
