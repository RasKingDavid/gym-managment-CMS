<!-- Modal -->
    <div id="deleteModal-{{$member->id}}" class="modal member inmodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content animated bounceInRight">
                <div class="modal-header " style="background: rgb(202, 22, 22); color:#fff">
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirm</h4>
                </div>
                <div class="modal-body">
                    <div class="" style="text-align: center !important">
                        <img src="{{ asset('media/icons/delete.gif') }}" alt="" width="200" height="150">
                    </div>
                    <p class="text-center">Are you sure you want to delete member {{ $member->name }} ? </p><br>
                    <p class="text-center">if you delete member <b style="color: royalblue">[ {{ $member->name }} ]</b> you will lost all the related records in your system!</p>
                </div>
                <div class="modal-footer">
                    {!! Form::Open(['action'=>['MembersController@archive',$member->id],'method' => 'POST','id'=>'archiveform-'.$member->id]) !!}
                    <input type="submit" class="btn btn-danger" value="Yes" id="btn-{{ $member->id }}"/>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    {!! Form::Close() !!}
                </div>
            </div>
        </div>
    </div>