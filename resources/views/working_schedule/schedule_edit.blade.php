@extends('app')

@section('header_scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
@endsection

@section('content')
    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('flash::message')
                </div>
               <div class="col-md-12">
                    <form action="{{ route('working-schedule.update', $schedule->id) }}" method="post" enctype="multipart/form-data">
                        <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <select name="member_id" hidden style="width:100%" required>
                                    <option value="{{ $schedule->member_id }}"></option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="">Day:</label>
                                <select name="day" class="form-control" required>
                                    <option value="{{ $schedule->day }}">{{ $schedule->day }}</option>
                                    <option value="Sunday">Sunday</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Time:</label>
                                <input type="text" name="time" class="form-control timepicker" value="{{ $schedule->time }}" required>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-md pull-right" style="margin-top: 10px"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;add schedule</button>
                            </div>
                        </div>
                    </form>
               </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script_init')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select a member..",
                allowClear: true
            });
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $('.timepicker').datetimepicker({
                format: 'LT'
            });
        });
     </script>
@endsection