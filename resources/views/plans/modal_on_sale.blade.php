 <!-- Modal -->
                                <div id="planOnSaleModal-{{$plan->id}}" class="modal delete inmodal" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content animated bounceInRight">
                                            <div class="modal-header ">
                                                <button type="button" class="close text-black" data-dismiss="modal">&times;</button>
                                                <h3 class="modal-title">Add On sale Price for {{ $plan->plan_name }} Plan</h3>
                                            </div>
                                            <div class="modal-body">
                                           {!! Form::model($planonsale->where('plan_id', $plan->id)->first(), ['method' => 'POST','action' => ['PlansController@PlanOnSales']]) !!}
                                            {{-- <form action="{{ route('plans.onsales') }}" method="post"> --}}
                                              <div class="form-group">
                                                {!! Form::hidden('plan_id', $plan->id,null,['class'=>'form-control', 'id' => 'amount']) !!}  
                                              </div>    
                                              <div class="form-group">
                                                {!! Form::label('amount', 'Price') !!}
                                                {!! Form::text('amount', $plan->amount,['class'=>'form-control', 'id' => 'amount', 'readonly']) !!}  
                                              </div> 
                                              <div class="form-group">
                                                {!! Form::label('discount', 'Discount Price ') !!}
                                                {!! Form::text('discount', null,['class'=>'form-control', 'id' => 'taginput', 'data-role' => 'tagsinput', 'multiple']) !!}  
                                              </div> 

                                              <div class="form-group">
                                                {!! Form::label('month', 'Months') !!}
                                                {!! Form::select('month', $plan_months, null,['class'=>'form-control selectpicker', 'id' => 'amount', 'multiple']) !!}  
                                              </div> 
                                                <p>Selected Months</p>  <select  disabled id="" class="form-control selectpicker" multiple>
                                                  @foreach ($plan_months as $key => $month)
                                                      <option value="{{ $month }}" 
                                                      @foreach ($planonsale->where('plan_id', $plan->id) as $planmonth) 
                                                      @if($planmonth->month == $month) selected 
                                                      @endif 
                                                      @endforeach>
                                                      {{ $month }} 
                                                    </option>
                                                  @endforeach
                                                  
                                                </select>  
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success" value="">Add Onsale</button>
                                                {{-- <a href="#" type="submit" class="bt btn-info"> Add Onsales</a> --}}
                                                {!! Form::Close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

  

                                {{-- onsale Modal details --}}

                                 <!-- Modal -->
                                <div id="onsaleDetailModal-{{$plan->id}}" class="modal onsaledetail inmodal" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content animated bounceInleft">
                                            <div class="modal-header " style="background:{{ $settings['theme_color'] }}; color: #fff;">
                                                <button type="button" class="close text-black" data-dismiss="modal">&times;</button>
                                                <h3 class="modal-title">List of OnSale Price for {{ $plan->plan_name }} Plan</h3>
                                            </div>
                                            <div class="modal-body">
                                               @foreach ($planonsale as $onsale)
                                               <div class="card-columns">
                                            <div class="card">
                                              <div class="card-body">
                                                  <div class="row">
                                                      <div class="col-sm-4 mb-2 mb-md-0"> <button class="btn btn-out btn-primary btn-square btn-large" data-toggle="modal" data-target="#myModal-{{ $onsale->id }}"> <i class="fa fa-tag"></i> {{ $onsale->month }}</button> </div>
                                                      <div class="col-sm-4">
                                                        <div class="modal fade" id="deleteOnsale-{{ $onsale->id }}">
                                                          <div class="modal-dialog">
                                                            <div class="modal-content">
                                                              <div class="modal-header" style="background: {{ $settings['theme_color'] }}; color:#fff">
                                                                <div class="modal-title">Delete </div>
                                                              </div>
                                                              <div class="modal-body text-center">
                                                                <h4>are you sure yiu want to delete this?</h4>
                                                              </div>
                                                              <div class="modal-footer">
                                                                <form action="{{ route('plans.onsalesdelete') }}" method="POST" >
                                                                  {!! Form::hidden('planonsale_id', $onsale->id, ['class'=>'form-control', 'id' => 'planonsale_id']) !!}  
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <button data-toggle="modal" data-target="#deleteOnsale-{{ $onsale->id }}" @if($plan->amount == $onsale->discount) class="btn btn-out btn-primary btn-square btn-large" @else class="btn btn-out btn-danger btn-square btn-large" @endif> <i class="fa fa-usd"></i>
                                                        @if ($plan->amount == $onsale->discount)
                                                          {{ number_format($onsale->discount, 2) }} @else  <del>{{ number_format($onsale->discount, 2) }}</del>
                                                        @endif
                                                      </button>
                                                    </div>
                                                      <div class="col-sm-4"> <button class="btn btn-out btn-primary btn-square btn-large"> <i class="fa fa-usd"></i> {{ number_format($plan->amount, 2) }}</button></div>
                                                  </div>
                                              </div>
                                            </div>
                                            </div>

                                            <div id="myModal-{{ $onsale->id }}" class="modal update fade" role="dialog">
                                                      <div class="col-md-6">
                                                          <div class="card">
                                                              <div class="card-body"> 
                                                                  {!! Form::open(['method' => 'POST','action' => ['PlansController@PlanOnSales']]) !!}
                                                                    {{-- <form action="{{ route('plans.onsales') }}" method="post"> --}}
                                                                      <div class="form-group">
                                                                        {!! Form::hidden('plan_id', $plan->id, ['class'=>'form-control', 'id' => 'amount']) !!}  
                                                                        {!! Form::hidden('planonsale_id', $onsale->id, ['class'=>'form-control', 'id' => 'planonsale_id']) !!}  
                                                                         <b class="title">Update {{ $plan->plan_name }} Onsale Plan </b>
                                                                      </div>    
                                                                      <div class="form-group">
                                                                        {!! Form::label('amount', 'Price') !!}
                                                                        {!! Form::text('amount', $plan->amount,['class'=>'form-control', 'id' => 'amount', 'readonly']) !!}  
                                                                      </div> 
                                                                      <div class="form-group">
                                                                        {!! Form::label('discount', 'Discount Price ') !!}
                                                                        {!! Form::text('discount', $onsale->discount, ['class'=>'form-control', 'id' => 'taginput', 'data-role' => 'tagsinput', 'multiple']) !!}  
                                                                      </div> 

                                                                      <div class="form-group">
                                                                        {!! Form::label('month', 'Months') !!}
                                                                        <select  id="" name="month" class="form-control selectpicker" multiple>
                                                                          @foreach ($plan_months as $key => $month)
                                                                              <option value="{{ $month }}" 
                                                                              @if($onsale->month == $month) selected 
                                                                              @endif>
                                                                              {{ $month }} 
                                                                            </option>
                                                                          @endforeach
                                                                        </select>  
                                                                      </div> 
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> --}}
                                                                        <button type="submit" class="btn btn-success" value="">Update Onsale</button>
                                                                        {{-- <a href="#" type="submit" class="bt btn-info"> Add Onsales</a> --}}
                                                                        {!! Form::Close() !!}
                                                              </div>
                                                          </div>
                                                      </div>
                                                  {{-- </div> --}}
                                              {{-- </div> --}}
                                          </div>

                                             @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



  <style>

 .card {
     position: relative;
     display: flex;
     width: 100%;
     flex-direction: column;
     min-width: 0;
     word-wrap: break-word;
     background-color: #fff;
     background-clip: border-box;
     border: 1px solid #d2d2dc;
     border-radius: 2px;
     -webkit-box-shadow: 0px 0px 5px 0px rgb(249, 249, 250);
     -moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1);
     box-shadow: 0px 0px 5px 0px rgb(161, 163, 164)
 }

 .card .card-body {
     padding: 1rem 1rem
 }

 .card-body {
     flex: 1 1 auto;
     padding: 1.25rem
 }

 .title {
     font-size: 25px;
     font-weight: 300;
     margin-top: 17px;
     color: #544a26
 }

 .description {
     font-size: 14px;
     color: #867f64
 }

 .mt-30 {
     margin-top: 30px
 }

 .modal.onsaledetail {
     text-align: center !important;
     margin-top: 50px
 }

  </style>