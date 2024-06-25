@extends('layout.panel')

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('dashboard')}}">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('mensualidad')}}">Listado de mensualidades</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Ver detalle de mensualidades</span>
        </li>
    </ul>
</div>
@endsection

@section('content')

<h3 class="page-title"> Ver detalle de mensualidad con nombre <strong>{{$mensualidad->nombre}}</strong>
</h3>
<div class="row" >	
		<div class="col-md-1" style="margin-bottom: 1em;">
	        <div class="btn-group">
	            <a class="btn sbold plomo" href="{{url('mensualidad')}}"> Volver al listado
	                <i class="fa fa-arrow-left"></i>
	            </a>
	        </div>
	    </div>	
</div>	
<div class="row" >	
    <div class="col-md-6 col-sm-12">
        <div class="portlet box plomot">
            <div class="portlet-title">
                <div class="caption colorwhite">
                    <i class="fa fa-user colorwhite"></i>Datos del mensualidad </div>

            </div>
            <div class="portlet-body">
                <div class="row static-info">
                    <div class="col-md-6 name"> Nombre</div>
                    <div class="col-md-6 value"> {{$mensualidad->nombre}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Gestion</div>
                    <div class="col-md-6 value"> {{$mensualidad->gestion->nombre}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  
@push('scripts')
<script>
    $('#navAdministracion').addClass('active open');
    $('#navAdministracion span.arrow').addClass('open');
    $('#itemMensualidad').addClass('active open');
</script>
@endpush