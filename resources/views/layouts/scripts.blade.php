@section('scripts')
<!-- jQuery -->
<script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!--Component Js -->
<script src="{{ asset('js/combo.js') }}"></script>
<!--Data Tables -->
<script src="{{ asset('/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!--Tosts-->
<script src="{{ asset('/plugins/toastr/toastr.min.js') }}"></script>
<!-- Toastr -->
<!-- SweetAlert2 -->
<script src="{{ asset('/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/dist/js/demo.js') }}"></script>
<!-- validation -->
<script src="{{asset('/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<!--commen functions-->
<script src="{{ asset('js/commenFunctions/functions.js') }}" type="text/javascript"></script>
<script src="{{asset('/js/commenFunctions/helperFunctions.js')}}"></script>
<script src="{{asset('/plugins/moment/moment.min.js')}}"></script>
<!--END OF SCRIPT-->
@endsection
