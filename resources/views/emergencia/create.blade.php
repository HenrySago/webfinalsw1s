@extends('layout.panel')

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('dashboard')}}">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('emergencia')}}">Listado de emergencia</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Nuevo emergencia</span>
        </li>
    </ul>
</div>
@endsection

@section('content')

<h3 class="page-title"> Nuevo emergencia
</h3>

<div class="row" >	
		<div class="col-md-1" style="margin-bottom: 1em;">
	        <div class="btn-group">
	            <a class="btn sbold plomo" href="{{url('cliente')}}"> Volver al listado
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
                <label>nombre <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="nombre" name="nombre" class="form-control form-control-sm" placeholder="Nombres" required="">
            </div>
            <div class="form-group col-md-6">
                <label>descripcion <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="descripcion" name="descripcion" class="form-control form-control-sm" placeholder="Apellidos" required="">
            </div>       
        </div>
 
        
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="single-append-text" class="control-label">Seleccione un tecnico <strong class="required" aria-required="true">*</strong></label>
                <select class="js-example-basic-single" id="id_tec" name="id_tec" required>
                    <option></option>
                    @foreach($colaboradores as $item)
                        <option value="{{$item->id}}">{{$item->nombres}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="single-append-text" class="control-label">Seleccione la ciudad <strong class="required" aria-required="true">*</strong></label>
                <select class="js-example-basic-single" id="id_zon" name="id_zon" required>
                    <option></option>
                    @foreach($ciudades as $item)
                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
     
        <div class="form-body col-md-12" style="margin-top: 1em;">
            <a  id="guardar" class="btn orange">Guardar</a>
            <a type="button" href="{{url('cliente')}}" class="btn plomo">Cancelar</a>
        </div>


    </form>


</div>

@endsection  
@push('scripts')     
<script src="{{asset('js/jquery.blockUI.js')}}" type="text/javascript"></script>  
<script src="https://maps.googleapis.com/maps/api/js?key={{456456}}"></script>
<script>
$(document).ready(function(){
	$('#navCooperativa').addClass('active open');
    $('#navCooperativa span.arrow').addClass('open');
	$('#itemEmergencia').addClass('active open');



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


	$('#guardar').click(function() {
       console.log('entre aqui');
		if (formulario.checkValidity()) {
			$.ajax({
				type: "POST",
				url: "{{url('emergencia/create')}}",
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

						setTimeout(function(){window.location = "/lectorMedidorWeb/public//emergencia"} , 2000);   

						
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




	  readURL = function(input) {
	    if (input.files && input.files[0]) {
	      var reader = new FileReader();
	      reader.onload = function(e) {
	        $('.image-upload-wrap').hide();

	        $('.file-upload-image').attr('src', e.target.result);
	        $('.file-upload-content').show();
	      };
	      reader.readAsDataURL(input.files[0]);
	    } else {
	      removeUpload();
	    }
	  }


	  removeUpload = function() {
	    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
	    $('.file-upload-content').hide();
	    $('.image-upload-wrap').show();
	    $('.file-upload-input').val('');
	      $('.image-upload-wrap').removeClass('image-dropping');
	      $('.file-upload-input').prop('required',true);
	  }

	  $('.image-upload-wrap').bind('dragover', function () {
	      $('.image-upload-wrap').addClass('image-dropping');
	  });

	  $('.image-upload-wrap').bind('dragleave', function () {
	      $('.image-upload-wrap').removeClass('image-dropping');
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
