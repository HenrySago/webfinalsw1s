@extends('layout.panel')

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('dashboard')}}">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('medicion')}}">Listado de mediciones</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Nueva medicion</span>
        </li>
    </ul>
</div>
@endsection

@section('content')

<h3 class="page-title"> Nueva medicion
</h3>

<div class="row" >	
		<div class="col-md-1" style="margin-bottom: 1em;">
	        <div class="btn-group">
	            <a class="btn sbold plomo" href="{{url('medicion')}}"> Volver al listado
	                <i class="fa fa-arrow-left"></i>
	            </a>
	        </div>
	    </div>	
</div>	

<h4 style="margin-bottom: 1em;"> Los campos con <strong style="color: red;">*</strong> son obligatorios</h4>


<div class="row portlet-body">


    <form method="post" action="" id="formulario" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="single-append-text" class="control-label">Seleccione la ciudad <strong class="required" aria-required="true">*</strong></label>
                <select class="js-example-basic-single" id="idCiudad" name="idCiudad" required>
                    <option></option>
                    @foreach($ciudades as $item)
                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="single-append-text" class="control-label">Seleccione la mensualidad <strong class="required" aria-required="true">*</strong></label>
                <select class="js-example-basic-single" id="idMensualidad" name="idMensualidad" required>
                    <option></option>
                    @foreach($mensualidades as $item)
                        <option value="{{$item->id}}">{{$item->nombre}} {{$item->gestion->nombre}} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-body col-md-12" style="margin-top: 1em;">
            <a  id="guardar" class="btn orange">Guardar</a>
            <a type="button" href="{{url('medicion')}}" class="btn plomo">Cancelar</a>
        </div>


    </form>


</div>

@endsection  
@push('scripts')     
<script src="{{asset('js/jquery.blockUI.js')}}" type="text/javascript"></script>  
<script>
$(document).ready(function(){
	$('#navCooperativa').addClass('active open');
    $('#navCooperativa span.arrow').addClass('open');
	$('#itemMedicion').addClass('active open');

	var formulario = document.getElementById('formulario');

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


	$('#guardar').click(function() {

		if (formulario.checkValidity()) {
			$.ajax({
				type: "POST",
				url: "{{url('medicion/create')}}",
				data: new FormData($("#formulario")[0]),
				dataType:'json',
				async:true,
				type:'post',
				processData: false,
				contentType: false,
				success: function( response ) {
					if (response.codigo==0) {
					
						toastr.success(response.mensaje, 'Satisfactorio!');
		               	toastr.options.closeDuration = 10000;
						toastr.options.timeOut = 10000;
						toastr.options.extendedTimeOut = 10000;

						setTimeout(function(){window.location = "/medicion"} , 2000);   

						
					   	//console.log(response.mensaje);
					}else{
						//console.log(response);
						toastr.error(response.mensaje, 'Ocurrio un error!');
		               	toastr.options.closeDuration = 10000;
						toastr.options.timeOut = 10000;
						toastr.options.extendedTimeOut = 10000;
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					//toastr.error(thrownError, 'Ocurrio un error!');
					//toastr.error(xhr.statusText, 'Ocurrio un error!');
					//toastr.error(ajaxOptions, 'Ocurrio un error!');
					//console.log(thrownError);
					//console.log(xhr);
					//console.log(ajaxOptions);
				
						var errors = xhr.responseJSON.errors;
		               	$.each( errors, function( key, value ) {
		               		toastr.error(value[0], 'Datos invalidos!');
			               	toastr.options.closeDuration = 10000;
							toastr.options.timeOut = 10000;
							toastr.options.extendedTimeOut = 10000;
		               	});

				}
			});
		}else{
			formulario.reportValidity();
		}

    }); 



});



$(document).ajaxStart(function (){

    $.blockUI({ 
		message: '<h3><img style="height: 90px;width: 90px;" src="{{asset('busy.gif')}}" /> Cargando </h3>',
		css: { 
	        border: 'none', 
	        padding: '15px', 
	        backgroundColor: '#000', 
	        '-webkit-border-radius': '10px', 
	        '-moz-border-radius': '10px', 
	        opacity: .5, 
	        color: '#fff'
		}
    });		
       
	}).ajaxStop(function (){
		$.unblockUI();
		}
	);

</script>
@endpush
