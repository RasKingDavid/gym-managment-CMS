@extends('app')

@section('content')

    <div class="rightside bg-grey-100">

        <div class="container-fluid">
            @include('flash::message')
            @permission(['manage-gymie','view-dashboard-quick-stats'])
            <!-- Stat Tile  -->
            {{-- <div class="row margin-top-10">
                <!-- Total Members -->
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    @include('dashboard._index.totalMembers')
                </div>

                <!-- Registrations This Weeks -->
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    @include('dashboard._index.registeredThisMonth')
                </div>

                <!-- Inactive Members -->
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    @include('dashboard._index.inActiveMembers')
                </div>

                <!-- Members Expired -->
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    @include('dashboard._index.expiredMembers')
                </div>

                <!-- Outstanding Payments -->
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    @include('dashboard._index.outstandingPayments')
                </div>

                <!-- Collection -->
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    @include('dashboard._index.collection')
                </div>
            </div> --}}

            <div class="row margin-top-10">
                <div class="container pt-5">
                    <div class="row align-items-stretch">

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
                    </div>
                </div>
            </div>
            @endpermission


             @permission(['manage-gymie','view-dashboard-charts'])
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel bg-white">
                        <div class="panel-title bg-transparent no-border">
                            <div class="panel-head">Registration Trend</div>
                        </div>
                        <div class="panel-body no-padding-top">
                            <div id="gymie-user-registrations" class="chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="panel bg-white">
                        <div class="panel-title bg-transparent no-border">
                            <div class="panel-head">Users Registration</div>
                        </div>
                        <div class="panel-body no-padding-top">
                            <div id="area-chart"  class="chart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="panel bg-white">
                        <div class="panel-title bg-transparent no-border">
                            <div class="panel-head">Registration Trend</div>
                        </div>
                        <div class="panel-body no-padding-top">
                            <div id="line-chart" id1="gymie-registrations-trend" class="chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="panel bg-white">
                        <div class="panel-title bg-transparent no-border">
                            <div class="panel-head">Stacked</div>
                        </div>
                        <div class="panel-body no-padding-top">
                            <div id="stacked"  class="chart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="panel bg-white">
                        <div class="panel-title bg-transparent no-border">
                            <div class="panel-head">Registration Trend</div>
                        </div>
                        <div class="panel-body no-padding-top">
                            <div id="line-chart" id1="gymie-registrations-trend" class="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            
             <div class="row">
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-title">
                            <div class="panel-head"><i class="fa fa-comments-o"></i>SMS Log</div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="panel bg-light-blue-400">
                                        <div class="panel-body padding-15-20">
                                            <div class="clearfix">
                                                <div class="pull-left">
                                                    <div class="color-white font-size-24 font-roboto font-weight-600" data-toggle="counter" data-start="0"
                                                         data-from="0" data-to="{{ \Utilities::getSetting('sms_balance') }}" data-speed="500"
                                                         data-refresh-interval="10"></div>
                                                </div>

                                                <div class="pull-right">
                                                    <i class="font-size-24 color-light-blue-100 fa fa-comments"></i>
                                                </div>

                                                <div class="clearfix"></div>

                                                <div class="pull-left">
                                                    <div class="display-block color-light-blue-50 font-weight-600">SMS balance</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($smsRequestSetting == 0)
                                    <div class="col-lg-7">
                                        <button class="btn btn-labeled btn-success pull-right margin-top-20" data-toggle="modal" data-target="#smsRequestModal"
                                                data-id="smsRequestModal"><span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Request more sms
                                        </button>
                                    </div>
                                @endif
                            </div>
                            @include('dashboard._index.smsLog', ['smslogs' => $smslogs])
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="panel bg-white">
                        <div class="panel-title">
                            <div class="panel-head">Members Per Plan</div>
                        </div>
                        <div class="panel-body padding-top-10">
                            @if(!empty($membersPerPlan))
                                <div id="gymie-members-per-plan" class="chart"></div>
                            @else
                                <div class="tab-empty-panel font-size-24 color-grey-300">
                                    <div id="gymie-members-per-plan" class="chart"></div>
                                    No Data
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            
            @endpermission

           


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
            gymie.loadmorris();
        });
    </script>
@stop
