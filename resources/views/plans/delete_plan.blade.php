 <!-- Modal -->
                                <div id="planWarningModal-{{$plan->id}}" class="modal delete inmodal" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content animated bounceInRight">
                                            <div class="modal-header " @if ($dependency == 'true') style="background: #E67E22; color:#fff" @else  style="background: rgb(202, 22, 22); color:#fff" @endif ">
                                                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                @if ($dependency == 'true')
                                                <h4 class="modal-title">Warning</h4>
                                                @else 
                                                <h4 class="modal-title">Confirm</h4>
                                                @endif 
                                            </div>
                                            <div class="modal-body">
                                                 @if ($dependency == 'true')
                                                <div class="" style="text-align: center !important">
                                                   <img src="{{ asset('media/icons/warning.gif') }}" alt="" width="200" height="170">
                                                </div>
                                                <p class="text-center msg">Are you sure you want to delete this ? </p><br>
                                                <p class="text-center">You have <b style="color:red">{{ count(App\Plan_Service::where('plan_id', $plan->id)->get()) }}</b> 
                                                    @if (count(App\Plan_Service::where('plan_id', $plan->id)->get()) == 1) member @else members 
                                                        
                                                    @endif assigned to this <b style="color: royalblue">[ {{ $plan->plan_name }} ]</b>, either delete the plan or assign them to new plan!</p>
                                                @else 
                                                 <div class="" style="text-align: center !important">
                                                   <img src="{{ asset('media/icons/delete.gif') }}" alt="" width="200" height="150">
                                                </div>
                                                <p class="text-center msg"> Are you sure you want to delete this ? </p><br>
                                                <p class="text-center">if you delete this Plan of <b style="color: royalblue">[ {{ $plan->plan_name }} ]</b> you will lost all the related records in your system!</p>
                                            </div>
                                                @endif
                                            <div class="modal-footer">
                                                 @if ($dependency == 'false')
                                                {{-- {!! Form::Open(['action'=>['PlansController@delete',$plan->id],'method' => 'POST']) !!} --}}
                                                <input type="submit" class="btn btn-danger" value="Yes" id="btn-{{ $plan->id }}"/>
                                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                                @else 
                                                <button type="button" class="btn btn-warning modal-dismiss" data-dismiss="modal">Ok</button>
                                                {!! Form::Close() !!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>