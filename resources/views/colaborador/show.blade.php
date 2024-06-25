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
            <span>Ver detalle de colaborador</span>
        </li>
    </ul>
</div>
@endsection

@section('content')

<h3 class="page-title"> Ver detalle de colaborador con nombres <strong>{{$colaborador->nombres}}</strong>
</h3>
<div class="row" >	
		<div class="col-md-1" style="margin-bottom: 1em;">
	        <div class="btn-group">
	            <a class="btn sbold plomo" href="{{url('colaborador')}}"> Volver al listado
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
                    <i class="fa fa-user colorwhite"></i>Datos del colaborador </div>

            </div>
            <div class="portlet-body">
                <div class="row static-info">
                    <div class="col-md-6 name"> Nombres</div>
                    <div class="col-md-6 value"> {{$colaborador->nombres}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Apellidos</div>
                    <div class="col-md-6 value"> {{$colaborador->apellidos}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Celular</div>
                    <div class="col-md-6 value"> {{$colaborador->celular}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Ci</div>
                    <div class="col-md-6 value"> {{$colaborador->ci}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Email </div>
                    <div class="col-md-6 value"> {{$colaborador->email}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Ciudad </div>
                    <div class="col-md-6 value"> {{$colaborador->ciudad->nombre}}</div>
                </div>
                <div class="row static-info" >
                    <div class="col-md-6 name" > Perfil</div>
                    <div class="col-md-6 value"> <img src="{{asset($colaborador->perfil)}}" alt="Fotografia" style="width: 70px;height: 70px;border-radius: 100% !important;">

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
    $('#itemColaborador').addClass('active open');
</script>
@endpush