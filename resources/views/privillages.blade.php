@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('pageStyles')
<link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
<style>
    .invalid {
        color: #FF0000;
    }
</style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Employee Profile</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">User Profile</li>
            </ol>
        </div>
    </div>
    <div class="card card-gray">
        <div class="card-header">
            <h3 class="card-title">Privileges</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>User Level</label>
                <input name="nic" type="text" class="form-control form-control-sm" value="{{$level['name']}}"
                       disabled="true">
            </div>
            <div class="form-group">
                <label>User Role</label>
                <select class="form-control select2 select2-purple roleCombo"
                        data-dropdown-css-class="select2-purple"
                        style="width: 100%;" name="level">
                    @foreach($roles as $role)
                    @if ($user['roll_id'] == $role['id'])
                    <option value="{{$role['id']}}"
                            selected>{{$role['name']}}</option>

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
                        <td align="center"><input class="form-check-input read"
                                                  type="checkbox" value="option1">
                        </td>
                        <td align="center">
                            <input class="form-check-input write" type="checkbox"
                                   value="option1">
                        </td>
                        <td align="center">
                            <input class="form-check-input update" type="checkbox"
                                   value="option1">
                        </td>
                        <td align="center">
                            <input class="form-check-input delete" type="checkbox"
                                   value="option1">
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
</section>
<!--/.content-->

@endsection

@section('pageScripts')
<!--Page script-->
<script src="{{asset('/plugins/fontawesome-free/css/all.min.css')}}"></script>
@endsection

