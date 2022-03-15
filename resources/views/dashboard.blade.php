@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('pageStyles')

@endsection
@section('content')
<section class="content-header">

</section>
@endsection

@section('pageScripts')
<!-- Page script -->

<!-- date-range-picker -->
<script src="{{asset('/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->

<script src="{{asset('/js/Dashboard/dashboard.js')}}"></script>

<script>

</script>
@endsection