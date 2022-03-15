@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('pageStyles')

@endsection
@section('content')
@if($pageAuth['is_read']==1 || false)

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-sm-6">
                <h1>System Users</h1>
            </div>
        </div>
    </div>
</section>



<section class="content-header">
    <div class="container-fluid">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-md-5">
                <div class="card card-success">
                    <div class="card-header">
                        <label>Basic Information</label>
                    </div>

                    <form method="POST" action="/users/id/{{$user['id']}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>First Name</label>
                                <input name="firstName" type="text" class="form-control form-control-sm" placeholder="Enter First Name" value="{{$user['name']}}">
                                @error('roll')
                                <p class="text-danger">{{$errors->first('name')}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input name="lastName" type="text" class="form-control form-control-sm" placeholder="Enter Last Name" value="{{$user['last_name']}}">
                                @error('roll')
                                <p class="text-danger">{{$errors->first('lastName')}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input name="userName" type="text" class="form-control form-control-sm" placeholder="Enter User Name" value="{{$user['name']." ".$user['last_name']}}">
                                @error('roll')
                                <p class="text-danger">{{$errors->first('userName')}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control form-control-sm" rows="3" placeholder="Enter Address" name="address">{{$user['address']}}</textarea>
                                @error('address')
                                <p class="text-danger">{{$errors->first('address')}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Contact No</label>
                                <input name="contactNo" type="text" class="form-control form-control-sm" placeholder="Enter Contact No" value="{{$user['contact_no']}}">
                                @error('contactNo')
                                <p class="text-danger">{{$errors->first('contactNo')}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="text" class="form-control form-control-sm" placeholder="Enter Email" value="{{$user['email']}}">
                                @error('email')
                                <p class="text-danger">{{$errors->first('email')}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>NIC</label>
                                <input name="nic" type="text" class="form-control form-control-sm" placeholder="Enter NIC" value="{{$user['nic']}}">
                                @error('nic')
                                <p class="text-danger">{{$errors->first('nic')}}</p>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer">
                            @if($pageAuth['is_update']==1 || false)
                            <button type="submit" class="btn btn-warning">Update</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Privileges</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>User Level</label>
                            <input name="nic" type="text" class="form-control form-control-sm" value="{{$level['name']}}" disabled="true">
                        </div>
                        <div class="form-group">
                            <label>User Role</label>
                            <select class="form-control select2 select2-purple roleCombo" data-dropdown-css-class="select2-purple" style="width: 100%;" name="level">
                                @foreach($roles as $role)
                                @if ($user['roll_id'] == $role['id'])
                                <option value="{{$role['id']}}" selected>{{$role['name']}}</option>

                                @else
                                <option value="{{$role['id']}}">{{$role['name']}}</option>
                                @endif
                                @endforeach

                            </select>
                        </div>
                        <table class="table table-condensed assignedPrivilages" id="as">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Previlage</th>
                                    <th style="width: 20px">Read</th>
                                    <th style="width: 20px">Write</th>
                                    <th style="width: 20px">Update</th>
                                    <th style="width: 20px">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($privileges as $indexKey =>$privilege)
                                <tr id="pre{{$privilege['id']}}">
                                    <td>{{$indexKey+1}}.</td>
                                    <td>{{$privilege['name']}}</td>
                                    <td align="center"><input class="form-check-input read" type="checkbox" value="option1">
                                    </td>
                                    <td align="center">
                                        <input class="form-check-input write" type="checkbox" value="option1">
                                    </td>
                                    <td align="center">
                                        <input class="form-check-input update" type="checkbox" value="option1">
                                    </td>
                                    <td align="center">
                                        <input class="form-check-input delete" type="checkbox" value="option1">
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" id="btnReset">Reset</button>
                        <button type="button" class="btn btn-success" id="btnSetRollPrivilege">Default Privilege
                        </button>
                        @if($pageAuth['is_update']==1 || true)
                        <button type="button" class="btn btn-warning" id="btnAssign">Assign</button>
                        @endif
                    </div>
                </div>
                @if($pageAuth['is_update']==1 || false)
                <form method="POST" action="/users/password/{{$user['id']}}">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Credentials</h3>
                        </div>
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control form-control-sm" placeholder="Enter Password">
                                @error('password')
                                <p class="text-danger">{{$errors->first('password')}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input name="password_confirmation" type="password" class="form-control form-control-sm" placeholder="Re-enter Password">
                                @error('password_confirmation')
                                <p class="text-danger">{{$errors->first('password_confirmation')}}</p>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Reset Password</button>
                        </div>

                    </div>
                </form>
                @endif
                @if($pageAuth['is_update']==1 || false)
                <form method="POST" action="/users/password/{{$user['id']}}">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">User Activity</h3>
                        </div>
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">

                                <label>Active Status</label>
                                <select class="form-control select2 select2-purple activityCombo" data-dropdown-css-class="select2-purple" style="width: 100%;" name="level">
                                    @foreach($activitys as $key=>$activity)
                                    {{-- @if ($user['roll_id'] == $role['id'])--}}
                                    {{-- <option value="{{$role['id']}}"--}}
                                    {{-- selected>{{$role['name']}}</option>--}}

                                    {{-- @else--}}
                                    <option value="{{$key}}">{{$activity}}</option>
                                    {{-- @endif--}}
                                    @endforeach

                                </select>

                            </div>
                        </div>
                        <div class="card-footer">
                            @if($pageAuth['is_delete']==1 || false)
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">
                                Delete User
                            </button>
                            @endif
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
@if($pageAuth['is_delete']==1 || true)
<div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Delete User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Are you sure you want to permanently delete this user ? </b></p>
                <p>Once you continue, this process can not be undone. Change Active Status to
                    <b>Inactive</b> if
                    you
                    want to keep the user and disable from the system(Recommended)
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <form action="/users/id/{{$user['id']}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-light">Delete Permanently</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endif
<!-- /.modal -->
@endif
@endsection



@section('pageScripts')
<script src="{{ asset('/js/userjs/user_update.js') }}"></script>
<script src="{{ asset('/js/userjs/roll.js') }}"></script>
<script src="{{ asset('/js/userjs/submit.js') }}"></script>

<!-- Page script -->
<script>
    $(function() {

        @if(session('success'))
        Toast.fire({
            type: 'success',
            title: 'Security Payroll  Management System</br>User Saved'
        });
        @endif

        @if(session('error'))
        Toast.fire({
            type: 'error',
            title: 'Security Payroll  Management System</br>Error'
        });
        @endif


        //Initialize Select2 Elements
        var userId = "{{$user['id']}}";
        var rollId = "{{$user['roll_id']}}";
        // $('.select2').select2();
        loadUserPrevilages(userId, rollId);

        $('.roleCombo').change(function() {
            // load the default assigned privileges in a user roll
            loadPrevilages(this.value);
        });
        $('.activityCombo').change(function() {
            // alert(this.value);
            var data = {
                'status': this.value
            }
            changeAciveStatus(userId, data, function() {
                // alert('User Changes to \'' + $(".activityCombo option:selected").html() + '\' status');
                Toast.fire({
                    type: 'success',
                    title: 'Security Payroll  Management System</br>User Changes to \'' + $(".activityCombo option:selected").html() + '\' status'
                });
            });
        });
        $('#btnSetRollPrivilege').click(function() {
            // alert(this.value);
            loadPrevilages($('.roleCombo').val());
        });
        $('#btnReset').click(function() {
            // rest un saved privileges
            loadUserPrevilages(userId);
            // $('.roleCombo').val(rollId);
        });
        $('#btnAssign').click(function() {
            // saving privileges
            assignPrivilegesToUser(userId, function() {
                rollId = $('.roleCombo').val();
                Toast.fire({
                    type: 'success',
                    title: 'Security Payroll  Management System</br>Privilege changed successfully'
                });
                loadUserPrevilages(userId);
            });
        });
    })
</script>

@endsection