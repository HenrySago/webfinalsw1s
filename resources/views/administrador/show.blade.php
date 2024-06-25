@extends('layout.panel')

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('dashboard')}}">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('colaborador')}}">Listado de colaboradores</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Ver detalle de colaboradores</span>
        </li>
    </ul>
</div>
@endsection

@section('content')

<h3 class="page-title"> Ver detalle de administrador con nombre <strong>{{$administrador->name}}</strong>
</h3>
<div class="row" >	
		<div class="col-md-1" style="margin-bottom: 1em;">
	        <div class="btn-group">
	            <a class="btn sbold plomo" href="{{url('administrador')}}"> Volver al listado
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
                    <i class="fa fa-user colorwhite"></i>Datos del administrador </div>

            </div>
            <div class="portlet-body">
                <div class="row static-info">
                    <div class="col-md-6 name"> Nombre</div>
                    <div class="col-md-6 value"> {{$administrador->name}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Ci</div>
                    <div class="col-md-6 value"> {{$administrador->ci}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Email </div>
                    <div class="col-md-6 value"> {{$administrador->email}}</div>
                </div>
                <div class="row static-info" >
                    <div class="col-md-6 name" > Perfil</div>
                    <div class="col-md-6 value"> <img src="{{asset($administrador->perfil)}}" alt="Fotografia" style="width: 70px;height: 70px;border-radius: 100% !important;">

                    </div>
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
    $('#itemAdministrador').addClass('active open');
</script>
@endpush