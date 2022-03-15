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
    <button onclick="window.print()">Print this page</button>
    <div class="container-fluid">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{$surveyName->name}}</h3>
                </div>
                <div class="card-body" style="">
                    <table class="table" id="survey_names_tbl">
                        <tbody></tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</section>
@endsection



@section('pageScripts')
<!-- Page script -->

<script src="{{asset('/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
    $(function() {
        let id = "{{$id}}";
        load_attributesTbl(id);
    });
</script>
@endsection