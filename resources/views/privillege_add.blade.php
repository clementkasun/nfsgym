@can('admin-rights')
@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('pageStyles')

<style>
    .invalid {
        color: #FF0000;
    }

    .red_text {
        color: #FF0000;
    }
</style>

@endsection
<!-- BS Stepper -->
<link rel="stylesheet" href="{{asset('/plugins/bs-stepper/css/bs-stepper.min.css')}}">
<style>
    .error {
        color: red;
    }
</style>
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">

            </div>
            <div class="col-sm-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Privillege Add</li>
                </ol>
            </div>
        </div><!-- /.container-fluid -->
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Privillege Addition</h3>
                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="card card-default">
                                <div class="row m-2">
                                    <div class="col-4">
                                        <form id="privillege_form" enctype="multipart/form-data">
                                            <div class="card-body p-0">
                                                <div class="form-group">
                                                    <input type="text" id="privillege_update_id" hidden>
                                                    <label>Privillege Name:</label>
                                                    <input type="text" class="form-control" name="name" id="privillege_name" placeholder="Privillege Name" required />
                                                </div>
                                                <input type="button" name="privillege_add" id="privillege_add" value="Add" class="btn btn-success" />
                                                <input type="button" name="privillege_update" id="privillege_update" value="Update" class="btn btn-warning d-none" />
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-8">
                                        <table id="privillege_tbl" name="privillege_tbl" class="table table-bordered table-hover table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="3" class="text-center"><span>NO DATA FOUND</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                </div>
                <!-- /.card -->

            </div>
            <!--/.col (left) -->
            <!-- right column -->

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    <div class="clearfix"></div>
    <div id="loading_animation_div2" style="position: fixed;
         top: 50%;
         left: 50%;
         margin-top: -25px;
         margin-left: -25px;
         z-index: 9999;" class="loading_animation_content">
        <img id="loading_animation_img2" src="/storage/loading.gif" style="max-height:50px;">
    </div>
    <div class="backDrop loading_animation_content" style="background:rgba(255,255,255,0.81);
         position:fixed;
         left:0;
         top:0;
         width:100%;
         height:100%;	
         z-index:888;"></div>
</section>
<!-- /.content -->
@endsection

@section('pageScripts')
<!-- Page script -->

<!-- validation -->
<script src="{{asset('/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('/js/userjs/privilege_add.js') }}"></script>
<!-- AdminLTE App -->
<script>
    $(document).ready(function() {
        $(".loading_animation_content").addClass('d-none');
        load_privillege_tbl();
    });

    $('#privillege_add').click(function() {
        var is_valid = $("#privillege_form").valid();
        if (is_valid) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Record will be saved",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.value) {
                    let data = $('#privillege_form').serializeArray();
                    save_privillege(data);
                }
            });
        }
    });


    $('#privillege_update').click(function() {
        var is_valid = $("#privillege_form").valid();
        if (is_valid) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Record will be update",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.value) {
                    let data = $('#privillege_form').serializeArray();
                    let id = $('#privillege_update_id').val();
                    update_privillege(id, data);
                }
            });
        }
    });

    $(document).on('click', '.edit', function() {
        let url = '/actions/edit_privillege/id/' + $(this).val();
        ajaxRequest('GET', url, null, function(returndata) {
            $('#privillege_add').addClass('d-none');
            $('#privillege_update').removeClass('d-none');

            $('#privillege_update_id').val(returndata.id);
            $('#privillege_name').val(returndata.name);
        });
    });

    $(document).on('click', '.delete', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Record will be delete",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.value) {
                delete_privillege($(this).val());
            }
        });
    });
</script>
@endsection
@endcan