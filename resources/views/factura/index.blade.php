@extends('layout.panel')

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('dashboard')}}">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Listado de facturas</span>
        </li>
    </ul>
</div>
@endsection

@section('content')
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<h3 class="page-title"> Listado de facturas
    <!-- <small>material design form inputs, checkboxes and radios</small> -->
</h3>

<div class="row" >
    <div class="form-group col-md-1">
        <a class="btn sbold plomo" href="{{url('dashboard')}}"> Atras
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>
</div>	

<div class="portlet-body">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            	<tr>
            		<th style="width: 50%;">
						<a class="btn btn-icon-only default round">
							<i class="fa fa-eye"></i> 
						</a>   
						Ver	            			
            		</th>
                    <th style="width: 50%;">
                        <a class="btn btn-icon-only red round">
                            <i class="fa fa-print"></i> 
                        </a>   
                        Imprimir                         
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>  

<div class="row">
    <div class="form-group col-md-2">
        <label for="single-append-text" class="control-label">Ciudad <strong class="required" aria-required="true">*</strong></label>
        <select class="js-example-basic-single" id="idCiudad" name="idCiudad" required>
            <option value="-1" selected>Todos</option>
            @foreach($ciudades as $item)
                <option value="{{$item->id}}">{{$item->nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        <label for="single-append-text" class="control-label">Mensualidad <strong class="required" aria-required="true">*</strong></label>
        <select class="js-example-basic-single" id="idMensualidad" name="idMensualidad" required>
            <option value="-1" selected>Todos</option>
            @foreach($mensualidades as $item)
                <option value="{{$item->id}}"> {{$item->nombre}} {{$item->gestion->nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        <label for="single-append-text" class="control-label">Colaborador <strong class="required" aria-required="true">*</strong></label>
        <select class="js-example-basic-single" id="idColaborador" name="idColaborador" required>
            <option value="-1" selected>Todos</option>
            @foreach($colaboradores as $item)
                <option value="{{$item->id}}">{{$item->nombres}} {{$item->apellidos}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        <label for="single-append-text" class="control-label">Estado <strong class="required" aria-required="true">*</strong></label>
        <select class="js-example-basic-single" id="estado" name="estado" required>
            <option value="-1" selected>Todos</option>
            <option value="0">No pagado</option>
            <option value="1">Pagado</option>
        </select>
    </div>
    <div class="form-group col-md-2">
    	<br>
        <a class="btn sbold orange" id="btnFiltar"> Filtrar
            <i class="fa fa-filter"></i>
        </a>
    </div>
    <div class="form-group col-md-2">
        <br>
        <a class="btn sbold orange" id="btnExportar"> Exportar
            <i class="fa fa-arrow-down"></i>
        </a>
    </div>
</div>

<div class="row">
 	<div class="col-md-12">
            
	    <div class="portlet box oranget">
	        <div class="portlet-title">
	            <div class="caption colorwhite">
	                <i class="fa fa-user colorwhite"></i>Listado de facturas </div>
	        </div>


	        <div class="portlet-body" id="cuerpo">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Mensualidad </th>
                                <th> Cliente </th>
                                <th> Referencia </th>
                                <th> Direccion </th>
                                <th> Estado </th>
                                <th> Consumo lecturado (m3) </th>
                                <th> Consumo real (m3) </th>
                                <th> Total (bs) </th>
                                <th> Opciones </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($facturas as $item)
                            <tr >
                                <td style="vertical-align: middle;">  {{$item->id}} </td>
                                <td style="vertical-align: middle;"> {{$item->medicion->mensualidad->nombre}} {{$item->medicion->mensualidad->gestion->nombre}} </td>
                                <td style="vertical-align: middle;"> {{$item->medicion->cliente->nombres}} {{$item->medicion->cliente->apellidos}}</td>
                                <td style="vertical-align: middle;"> {{$item->medicion->referencia}} </td>
                                <td style="vertical-align: middle;">  {{$item->medicion->direccion}} </td>
                                <td style="vertical-align: middle;"> 
                                    @if($item->pagado==1)
                                    <span style="width: 100%;padding: 3px;background-color: green;color: white">Pagado</span>
                                    @else
                                    <span style="width: 100%;padding: 3px;background-color: red;color: white">No pagado</span>
                                    @endif  
                                </td>
                                <td style="vertical-align: middle;"> {{$item->medicion->consumo}}</td>
                                <td style="vertical-align: middle;"> {{$item->medicion->consumoReal}}</td>
                                <td style="vertical-align: middle;"> {{$item->medicion->total}}</td>

                                <td style="vertical-align: middle;">       
                                        <a href="{{url('factura/'.$item->id)}}" class="btn btn-icon-only default round">
                                            <i class="fa fa-eye"></i>
                                        </a> 
                                        <a href="{{url('reporte/reporteFactura/'.$item->id)}}" target="_blank" class="btn btn-icon-only red round">
                                            <i class="fa fa-print"></i>
                                        </a>     
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
	        </div>


	    </div>
	</div>

</div>


@endsection
@push('scripts')     
<script>
$(document).ready(function(){

    $('#navPago').addClass('active open');
    $('#navPago span.arrow').addClass('open');
    $('#itemFactura').addClass('active open');

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

    $('#estado').select2({
            placeholder: "Seleccione el estado",
            allowClear: true,
            width: 'auto'
    });


    $('#btnExportar').on('click', function(){
        var idCiudad = $('#idCiudad').val();
        var idMensualidad = $('#idMensualidad').val();
        var idColaborador = $('#idColaborador').val();
        var estado = $('#estado').val();

        window.open('/facturaExcel/'+idCiudad+'/'+idMensualidad+'/'+idColaborador+'/'+pagado, '_blank');
    });



    $('#btnFiltar').on('click', function(){
        var idCiudad = $('#idCiudad').val();
        var idMensualidad = $('#idMensualidad').val();
        var idColaborador = $('#idColaborador').val();
        var estado = $('#estado').val();

        $.ajax({
            type: "GET",
            url: "{{url('factura/search')}}",
            data: {idCiudad:idCiudad, idMensualidad: idMensualidad,idColaborador:idColaborador,estado:estado},
            success: function( response ) {
                $('#cuerpo').html(response);
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    });


    
});




</script>
@endpush