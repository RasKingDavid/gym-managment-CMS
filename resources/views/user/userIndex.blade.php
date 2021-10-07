@extends('app')
<?php $settings = Utilities::getSettings() ?>
@section('content')

    <div class="rightside bg-grey-100">
        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100">
            @include('flash::message')
            <h1 class="page-title"> <i class="fa fa-user"></i> Users
            <a href="{{ action('AclController@createUser') }}" class="page-head-btn btn-sm btn-primary active" role="button"> Add New</a>
            <small>All plans of {{ $settings['gym_name'] }} </small>
        </h1>
        <h1 class="font-size-30 text-right color-blue-grey-600 animated fadeInDown total-count pull-right">
                <span class="label label-success" data-toggle="counter" data-start="0"
                      data-from="0" data-to="{{ $count }}"
                      data-speed="600"
                      data-refresh-interval="10"></span>
                <small class="color-blue-grey-600 display-block margin-top-10 font-size-14">Total Users</small>
            </h1>
        </div>

        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel no-border ">
                        <div class="panel-title bg-white no-border">
                        </div>
                        <div class="panel-body no-padding-top bg-white">
                            <table id="staffs" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Photo</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    @foreach ($users as $user)
                                      
                                        <td class="text-center"><img src="{{ asset('media/staff/' .$user->userDetail->image )}}" width="50px"></td>
                                        <td class="text-center">{{ $user->name}}</td>
                                        <td class="text-center">{{ $user->email}}</td>
                                        <td class="text-center">{{ $user->roleUser->role->name }}</td>

                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">Actions</button>
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{ action('AclController@editUser',['id' => $user->id]) }}">
                                                            Edit details
                                                        </a>
                                                    </li>
                                                    {{-- @if(Auth::user()->id != $user->id) --}}
                                                    @if(Auth::user()->hasRole(['Admin', 'Gymie']))
                                                        <li>
                                                            <a href="#" data-toggle="modal" data-target="#deleteModal-{{ $user->id }}" >Delete user</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                </tr>
                                @include('user.delete_user')

                                @endforeach


                                </tbody>
                            </table>

                        </div>
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
@stop