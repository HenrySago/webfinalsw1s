@extends('layout.panel')

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('dashboard')}}">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('mensualidad')}}">Listado de mensualidad</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Editar mensualidad</span>
        </li>
    </ul>
</div>
@endsection

@section('content')

<h3 class="page-title"> Editar mensualidad con nombre <strong>{{$mensualidad->nombre}}</strong>
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

<h4 style="margin-bottom: 1em;"> Los campos con <strong style="color: red;">*</strong> son obligatorios</h4>


<div class="row portlet-body">


    <form method="post" action="" id="formulario" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $mensualidad->id }}">


     	<div class="form-row">
            <div class="form-group col-md-6">
                <label>Nombre <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="nombre" name="nombre" class="form-control form-control-sm" placeholder="Nombre" required="" value="{{$mensualidad->nombre}}">
            </div>  
            <div class="form-group col-md-6">
                <label for="single-append-text" class="control-label">Seleccione la gestion <strong class="required" aria-required="true">*</strong></label>
                <select class="js-example-basic-single" id="idGestion" name="idGestion">
                    <option></option>
                    @foreach($gestiones as $item)
                    	@if($mensualidad->idGestion==$item->id)
                        <option value="{{$item->id}}" selected="">{{$item->nombre}}</option>
                        @else
                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>    
        </div>
 
        <div class="form-body col-md-12" style="margin-top: 1em;">
            <a  id="guardar" class="btn orange">Guardar</a>
            <a type="button" href="{{url('mensualidad')}}" class="btn plomo">Cancelar</a>
        </div>


    </form>


</div>

@endsection  
@push('scripts')     
<script src="{{asset('js/jquery.blockUI.js')}}" type="text/javascript"></script>  
<script>
$(document).ready(function(){
    $('#navAdministracion').addClass('active open');
    $('#navAdministracion span.arrow').addClass('open');
    $('#itemMensualidad').addClass('active open');
	
    $('#idGestion').select2({
            placeholder: "Seleccione la gestion",
            allowClear: true,
            width: 'auto'
    });


	var formulario = document.getElementById('formulario');

	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('input[name="_token"]').val()
		}
	});

	$('#guardar').click(function() {

		if (formulario.checkValidity()) {
			$.ajax({
				type: "POST",
				url: "{{url('mensualidad/update')}}",
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

						setTimeout(function(){window.location = "/mensualidad"} , 2000);   

						
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
