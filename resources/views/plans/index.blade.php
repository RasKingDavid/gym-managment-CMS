@extends('app')
<?php $settings = Utilities::getSettings() 
?>

@section('content')
    <div class="rightside bg-grey-100">

        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title no-line-height">Plans
                @permission(['manage-gymie','manage-plans','add-plan'])
                <a href="{{ action('PlansController@create') }}" class="page-head-btn btn-sm btn-primary active" role="button">Add New</a>
                <small>All plans of {{ $settings['gym_name'] }} </small>

            </h1>
            @permission(['manage-gymie','pagehead-stats'])
            <h1 class="font-size-30 text-right color-blue-grey-600 animated fadeInRight total-count pull-right">
                <span class="label label-success" data-toggle="counter" data-start="0"
                      data-from="0" data-to="{{ $count }}"
                      data-speed="600"
                      data-refresh-interval="10"></span>
                <small class="color-blue-grey-600 display-block margin-top-10 font-size-14">Total Plans</small>
            </h1>
            @endpermission
            @endpermission
        </div><!-- / PageHead -->

        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel no-border ">
                        <div class="panel-body no-padding-top bg-white">
                            <div class="row margin-top-15 margin-bottom-15">
                                <div class="col-xs-12 col-md-3 pull-right">
                                    {!! Form::Open(['method' => 'GET']) !!}
                                    <div class="btn-inline pull-right">
                                        <input name="search" id="search" type="text" class="form-control padding-right-35" placeholder="Search...">
                                        <button class="btn btn-link no-shadow bg-transparent no-padding-top padding-right-10" type="button">
                                            <i class="ion-search"></i></button>
                                    </div>
                                    {!! Form::Close() !!}

                                </div>
                            </div>

                            @if($plans->count() == 0)
                                <h4 class="text-center padding-top-15"><i class="fa fa-frown-o" aria-hidden="true"></i> No records found</h4>
                            @else

                                <table id="plans" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Plan Code</th>
                                        <th>Plan Name</th>
                                        <th>Service Name</th>
                                        {{-- <th>Plan Details</th> --}}
                                        <th>Days</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($plans as $plan)
                                        <tr>
                                            <?php $planson = $planonsale->where('plan_id', $plan->id)->first();?>
                                            
                                            <td>{{ $plan->plan_code}}</td>
                                            <td>{{ $plan->plan_name}} 
                                            @if (count($planonsale->where('plan_id', $plan->id)) > 0)
                                                    <p style="float: right; cursor: pointer;" class="label label-danger" data-toggle="modal" data-target="#onsaleDetailModal-{{ $plan->id }}"> on sale</p>
                                            @endif
                                            </td>
                                            <td width="30%">
                                                @if (count(App\Plan_Service::where('plan_id', $plan->id)->get()) > 0)
                                                @foreach ($services = App\Plan_Service::where('plan_id', $plan->id)->get() as $service)
                                                        
                                                        <span class="label label-info" style="padding-bottom: 2px !important">{{ $service->service->name}} &nbsp;&nbsp;</span> 
                                                @endforeach
                                                @else
                                                    <span class="text-center label label-danger">No Service</span>
                                                @endif
                                            </td>
                                            {{-- <td>{{ $plan->plan_details}}</td> --}}
                                            <td>{{ $plan->days}}</td>
                                            <td>$ 
                                                 @if (count($planonsale->where('plan_id', $plan->id)) > 0)
                                                    <del style="float: right"> $ {{ $plan->amount}}</del>
                                                    <b class="label label-success"> {{$planson->discount}}</b>
                                                @else 
                                                    {{ $plan->amount}}
                                                 @endif
                                            </td>
                                            <td>
                                                <span class="{{ Utilities::getActiveInactive ($plan->status) }}">{{ Utilities::getStatusValue ($plan->status) }}</span>
                                            </td>

                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#planOnSaleModal-{{ $plan->id }}"> add on sale</a> 
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Actions</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            @permission(['manage-gymie','manage-plans','edit-plan'])
                                                            <a href="{{ action('PlansController@edit',['id' => $plan->id]) }}">
                                                                Edit details
                                                            </a>
                                                            @endpermission
                                                        </li>
                                                        <li>
                                                            <?php
                                                            $dependency = ($plan->Subscriptions->isEmpty() ? "false" : "true");
                                                            ?>
                                                            @permission(['manage-gymie','manage-plans','delete-plan'])
                                                            <a href="#" data-toggle="modal" data-target="#planWarningModal-{{ $plan->id }}">
                                                                Delete plan
                                                            </a>
                                                            
                                                            @endpermission
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                       @include('plans.modal_on_sale')
                                        @include('plans.delete_plan')
                                        
                                    @endforeach
                                    </tbody>


                                </table>

                                <!-- Pagination -->
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="gymie_paging_info">
                                            Showing page {{ $plans->currentPage() }} of {{ $plans->lastPage() }}
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="gymie_paging pull-right">
                                            {!! str_replace('/?', '?', $plans->appends(Input::Only('search'))->render()) !!}
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.deleterecord();
        });
    </script>
    <script>
    $(document).ready(function(){
      alert($('#taginput').tagsinput('items'));
  })
  </script>
@stop 