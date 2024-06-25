@extends('layout.panel')

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <span>Dashboard</span>
        </li>
    </ul>
</div>
@endsection

@section('content')
<h3 style="font-size: 800;">Lo sentimos, usted no tiene permisos para ingresar a esta seccion.</h3>
@endsection
@push('scripts')     
<script>
$(document).ready(function(){

$('#navDashboard').addClass('active open');
$('#navDashboard span.arrow').addClass('open');
$('#itemDashboard').addClass('active open');

});
</script>
@endpush