{{-- <div class="panel bg-light-blue-400">
    <div class="panel-body padding-15-20">
        <div class="clearfix">
            <div class="pull-left">
                <div class="color-white font-size-24 font-roboto font-weight-600" data-toggle="counter" data-start="0" data-from="0"
                     data-to="{{ App\Member::where('status',1)->count() }}" data-speed="500" data-refresh-interval="10"></div>
            </div>

            <div class="pull-right">
                <i class="font-size-24 color-light-blue-100 fa fa-users"></i>
            </div>

            <div class="clearfix"></div>

            <div class="pull-left">
                <div class="display-block color-light-blue-50 font-weight-600">Total Members</div>
            </div>
        </div>
    </div>
</div><!-- /.panel --> --}}


<div class="wrap">
    <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">  
        <i class="font-size-24 color-light-blue-600 fa fa-users"></i>
        </h4><span class="hind-font caption-12 c-dashboardInfo__count">
        <div class=" font1-size-24 font-roboto font1-weight-600" data-toggle="counter" data-start="0" data-from="0"
                data-to="{{ App\Member::where('status',1)->count() }}" data-speed="500" data-refresh-interval="10"></div>
    </span>
        <span
        class="hind-font caption-12 c-dashboardInfo__subInfo">
        <a href="{{ url('members/all') }}">Joined Members</a> 
        </span>
</div>