@extends('layout.panel')

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('dashboard')}}">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Reporte general</span>
        </li>
    </ul>
</div>
@endsection

@section('content')
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<h3 class="page-title"> Reporte general
    <!-- <small>material design form inputs, checkboxes and radios</small> -->
</h3>

<div class="row" >
    <div class="form-group col-md-1">
        <a class="btn sbold plomo" href="{{url('dashboard')}}"> Atras
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>
</div>	

<div class="row">
    <div class="form-group col-md-3">
        <label for="single-append-text" class="control-label">Ciudad <strong class="required" aria-required="true">*</strong></label>
        <select class="js-example-basic-single" id="idCiudad" name="idCiudad" required>
            <option value="-1" selected>Todos</option>
            @foreach($ciudades as $item)
                <option value="{{$item->id}}">{{$item->nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="single-append-text" class="control-label">Mensualidad <strong class="required" aria-required="true">*</strong></label>
        <select class="js-example-basic-single" id="idMensualidad" name="idMensualidad" required>
            <option value="-1" selected>Todos</option>
            @foreach($mensualidades as $item)
                <option value="{{$item->id}}"> {{$item->nombre}} {{$item->gestion->nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="single-append-text" class="control-label">Colaborador <strong class="required" aria-required="true">*</strong></label>
        <select class="js-example-basic-single" id="idColaborador" name="idColaborador" required>
            <option value="-1" selected>Todos</option>
            @foreach($colaboradores as $item)
                <option value="{{$item->id}}">{{$item->nombres}} {{$item->apellidos}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="single-append-text" class="control-label">Cliente <strong class="required" aria-required="true">*</strong></label>
        <select class="js-example-basic-single" id="idCliente" name="idCliente" required>
            <option value="-1" selected>Todos</option>
            @foreach($clientes as $item)
                <option value="{{$item->id}}">{{$item->nombres}} {{$item->apellidos}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="single-append-text" class="control-label">Estado <strong class="required" aria-required="true">*</strong></label>
        <select class="js-example-basic-single" id="estado" name="estado" required>
            <option value="-1" selected>Todos</option>
            <option value="0">Sin medir</option>
            <option value="1">Medido</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="single-append-text" class="control-label">Pagado <strong class="required" aria-required="true">*</strong></label>
        <select class="js-example-basic-single" id="pagado" name="pagado" required>
            <option value="-1" selected>Todos</option>
            <option value="0">No pagado</option>
            <option value="1">Pagado</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <br>
        <a class="btn sbold orange" id="btnFiltar"> Generar reporte
            <i class="fa fa-filter"></i>
        </a>
    </div>
</div>


@endsection
@push('scripts')     
<script>
$(document).ready(function(){

	$('#navPago').addClass('active open');
    $('#navPago span.arrow').addClass('open');
	$('#itemReporteGeneral').addClass('active open');

	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('input[name="_token"]').val()
		}
	});

    $('#idCiudad').select2({
            placeholder: "Seleccione la ciudad",
            allowClear: true,
            width: 'auto'
    });
    $('#idMensualidad').select2({
            placeholder: "Seleccione la mensualidad",
            allowClear: true,
            width: 'auto'
    });
    $('#idColaborador').select2({
            placeholder: "Seleccione el colaborador",
            allowClear: true,
            width: 'auto'
    });
    $('#idCliente').select2({
            placeholder: "Seleccione el cliente",
            allowClear: true,
            width: 'auto'
    });
    $('#estado').select2({
            placeholder: "Seleccione el estado",
            allowClear: true,
            width: 'auto'
    });
    $('#pagado').select2({
            placeholder: "Seleccione el pago",
            allowClear: true,
            width: 'auto'
    });

    $('#btnFiltar').on('click', function(){
        var idCiudad = $('#idCiudad').val();
        var idMensualidad = $('#idMensualidad').val();
        var idColaborador = $('#idColaborador').val();
        var idCliente = $('#idCliente').val();
        var estado = $('#estado').val();
        var pagado = $('#pagado').val();

        window.open('/reporte/generarReporteGeneral/'+idCiudad+'/'+idMensualidad+'/'+idColaborador+'/'+idCliente+'/'+estado+'/'+pagado, '_blank');
    });


	
});




</script>
@endpush