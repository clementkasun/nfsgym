@can('admin-rights')
@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('pageStyles')
@endsection


@section('content')
@if($pageAuth == null)
{{header("Location: /logout")}}
{{exit()}}
@endif

{{-- {{dump($pageAuth)}}--}}
@if($pageAuth['is_read']==1 || false)
{{-- <h1>{{$p['name']}}</h1>--}}

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
            @if($pageAuth['is_create']==1 || false)
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <label>User Register</label>
                    </div>

                    <form method="POST" action="/users">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Email*</label>
                                <input name="email" type="text" class="form-control form-control-sm" placeholder="Enter Email" value="{{old('email')}}">
                                @error('email')
                                <p class="text-danger">{{$errors->first('email')}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input name="firstName" type="text" class="form-control form-control-sm" placeholder="Enter First Name" value="{{old('firstName')}}">
                                @error('roll')
                                <p class="text-danger">{{$errors->first('firstName')}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input name="lastName" type="text" class="form-control form-control-sm" placeholder="Enter Last Name" value="{{old('lastName')}}">
                                @error('roll')
                                <p class="text-danger">{{$errors->first('lastName')}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control form-control-sm" rows="3" placeholder="Enter Address" name="address">{{old('address')}}</textarea>
                                @error('address')
                                <p class="text-danger">{{$errors->first('address')}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Contact No</label>
                                <input name="contactNo" maxlength="10" type="text" class="form-control form-control-sm" placeholder="Enter Contact No" value="{{old('contactNo')}}">
                                @error('contactNo')
                                <p class="text-danger">{{$errors->first('contactNo')}}</p>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>NIC</label>
                                <input name="nic" type="text" maxlength="12" class="form-control form-control-sm" placeholder="Enter NIC" value="{{old('nic')}}">
                                @error('nic')
                                <p class="text-danger">{{$errors->first('nic')}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>User Level</label>

                                <select class="form-control select2 select2-purple levelCombo" data-dropdown-css-class="select2-purple" style="width: 100%;" name="level">
                                    <?php { {
                                            $levels = $levels;
                                        }
                                    }
                                    ?>
                                    @foreach($levels as $level)
                                    @if (old('level') == $level['id'])
                                    <option value="{{$level['id']}}" selected>{{$level['name']}}</option>

                                    @else
                                    <option value="{{$level['id']}}">{{$level['name']}}</option>
                                    @endif
                                    @endforeach

                                </select>
                            </div>
                            {{-- <div class="form-group">
                            <label>User Institute</label>

                                    <select class="form-control select2 select2-purple institut                                                        eCom                                                                    bo"
                                            data-dropdown-css-class="                                                        select2-purp                                                                    le"
                                            style="width: 10                                                        0%;" nam         e="institute">

                                    </select>
                            </div> --}}
                            <div class="form-group">
                                <label>User Role</label>

                                <select class="form-control select2 select2-purple rollCombo" data-dropdown-css-class="select2-purple" style="width: 100%;" name="roll">

                                </select>
                                @error('roll')
                                <p class="text-danger">{{$errors->first('roll')}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control form-control-sm" placeholder="Enter Password" value="">
                                @error('password')
                                <p class="text-danger">{{$errors->first('password')}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input name="password_confirmation" type="password" class="form-control form-control-sm" placeholder="Enter Password" value="{{old('password_confirmation')}}">
                                @error('password_confirmation')
                                <p class="text-danger">{{$errors->first('roll')}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">All Users</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed assignedPrivilages" id="tblUsers">
                            <thead>
                                <tr>
                                    <th style="width: 1em">#</th>
                                    <th>User Name</th>
                                    <th style="width: 5em">Roll</th>
                                    <th style="width: 4em">e-mail</th>
                                    <!--                                                                <th style="width: 5em">Status</th>-->
                                    <th style="width: 2em">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $indexKey=>$user)
                                <tr>
                                    <td style="width: 1em">{{$indexKey+1}}.</td>
                                    <td>{{$user['user_name']}}</td>
                                    <td style="width: 5em">{{$user['roll_name']}}</td>
                                    <td style="width: 4em">{{$user['user_email']}}</td>
                                    <!--                                                                <td>{{$user['user_status']}}</td>-->
                                    <td style="width: 2em">
                                        <a href="/users/id/{{$user['id']}}" class="btn btn-sm btn-success">Select</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-lg">Deleted Users </button>

                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Deleted Users</h3>

                                <div class="card-tools">
                                    <!-- <div class="input-group input-group-sm" style="width: 150px;">
                                                                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                        
                                                                            <div class="input-group-append">
                                                                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                                            </div>
                                                                        </div> -->
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height:300px;">
                                <table class="table table-head-fixed" id="tbl_deleted_users">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Deleted at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>



                </div>
                <div class="modal-footer justify-content-right">

                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    </div>
</section>

@endif
@endsection

@section('pageScripts')

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

        // loading roll combo at page start
        loadRolls($('.levelCombo').val(), 'rollCombo');
        // loading institute combo at page start

        //Initialize Select2 Elements
        // $('.select2').select2();
        $("#tblUsers").DataTable();
        loadRolls($('.levelCombo').val(), 'rollCombo');


        $('.levelCombo').change(function() {
            loadRolls(this.value, 'rollCombo');
        });
        //        load_deleted_user_table();
        $(document).on('click', '.btnAction', function() {
            //var row = JSON.parse(decodeURIComponent($(this).data('row')));
            if (confirm('Are you sure you want to restore this user ?')) {
                activeDeletedUser($(this).val());
            }
        });
    })
</script>
@endsection
@endcan