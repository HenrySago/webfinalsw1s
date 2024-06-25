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
            <span>Editar medicion</span>
        </li>
    </ul>
</div>
@endsection

@section('content')

<h3 class="page-title"> Editar medicion con # <strong>{{$medicion->id}}</strong>
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
        <input type="hidden" name="id" value="{{ $medicion->id }}">



     	<div class="form-row">
            <div class="form-group col-md-6">
                <label>Cliente <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="cliente" name="cliente" class="form-control form-control-sm" placeholder="Cliente" required="" value="{{$medicion->cliente->nombres}} {{$medicion->cliente->apellidos}}" readonly>
            </div>
            <div class="form-group col-md-6">
                <label>Administrador <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="administrador" name="administrador" class="form-control form-control-sm" placeholder="Administrador" required="" value="{{$medicion->administrador->name}}" readonly>
            </div>       
        </div>
 
     	<div class="form-row">
            <div class="form-group col-md-6">
                <label>Mensualidad <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="mensualidad" name="mensualidad" class="form-control form-control-sm" placeholder="Mensualidad" required="" value="{{$medicion->mensualidad->nombre}} {{$medicion->mensualidad->gestion->nombre}} "readonly>
            </div>
            <div class="form-group col-md-6">
                <label>Direccion <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="direccion" name="direccion" class="form-control form-control-sm" placeholder="Direccion" required="" value="{{$medicion->direccion}}"readonly>
            </div>     
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Consumo (m3) <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="consumo" name="consumo" class="form-control form-control-sm" placeholder="Consumo (m3)" required="" value="{{$medicion->consumo}}"readonly>
            </div>
            <div class="form-group col-md-6">
                <label>Total (bs) <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="total" name="total" class="form-control form-control-sm" placeholder="Total (bs)" required="" value="{{$medicion->total}}"readonly>
            </div>     
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Seleccione la ubicación precisa del domicilio <strong class="required" aria-required="true">*</strong></label>
                <div id="mapa" style="height: 400px; width: auto;"></div>
            </div>
        </div>
		<input type="hidden" id="latitud" name="latitud" value="{{$medicion->latitud}}">
		<input type="hidden" id="longitud" name="longitud" value="{{$medicion->longitud}}">

        @if($medicion->estado==1)
        <div class="form-group col-md-12">
            <label>Colaborador <strong class="required" aria-required="true">*</strong></label>
            <input type="text" id="colaborador" name="colaborador" class="form-control form-control-sm" placeholder="Colaborador" required="" value="{{$medicion->colaborador->nombres}} {{$medicion->colaborador->apellidos}}"readonly>
        </div>  
        @else
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="single-append-text" class="control-label">Seleccione el colaborador <strong class="required" aria-required="true">*</strong></label>
                <select class="js-example-basic-single" id="idColaborador" name="idColaborador">
                    <option></option>
                    @foreach($colaboradores as $item)
                        @if($medicion->idColaborador==$item->id)
                        <option value="{{$item->id}}" selected="">{{$item->nombres}} {{$item->apellidos}}</option>
                        @else
                        <option value="{{$item->id}}">{{$item->nombres}} {{$item->apellidos}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        @endif 






        <div class="form-body col-md-12" style="margin-top: 1em;">
            <a  id="guardar" class="btn orange">Guardar</a>
            <a type="button" href="{{url('medicion')}}" class="btn plomo">Cancelar</a>
        </div>


    </form>


</div>

@endsection  
@push('scripts')     
<script src="{{asset('js/jquery.blockUI.js')}}" type="text/javascript"></script> 
<script src="https://maps.googleapis.com/maps/api/js?key={{$gmpasKey}}"></script>

<script>
$(document).ready(function(){
	$('#navCooperativa').addClass('active open');
    $('#navCooperativa span.arrow').addClass('open');
	$('#itemMedicion').addClass('active open');


	var latitud = document.getElementById('latitud');
	var longitud = document.getElementById('longitud');

    var marcador = null;
    var ubicacionInicial = {
        lat: parseFloat(latitud.value), 
        lng: parseFloat(longitud.value)
    };
    function initMap() {
        mapa = new google.maps.Map(document.getElementById('mapa'), {
            center: ubicacionInicial,
            zoom: 14,
            streetViewControl: false,
            rotateControl: true,
            fullscreenControl: true,
            mapTypeControlOptions: {
                mapTypeIds: ['roadmap', 'satellite']
            }
        });
 
        latitud.value = ubicacionInicial.lat;
        longitud.value = ubicacionInicial.lng;

        var coordenadas = new google.maps.LatLng(parseFloat(latitud.value), parseFloat(longitud.value));
        posicionarMarcador(coordenadas, mapa);
    }


    function setCoordenadas(posicion) {
        latitud.value = posicion.lat();
        longitud.value = posicion.lng();
    }

    function posicionarMarcador(posicion, mapa) {
        if (marcador == null) {
            marcador = new google.maps.Marker({
                position: posicion,
                map: mapa
            });
        } else {
            marcador.setPosition(posicion);
        }
        mapa.panTo(posicion);
        setCoordenadas(posicion);
    }


    initMap();

	var formulario = document.getElementById('formulario');

	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('input[name="_token"]').val()
		}
	});

    $('#idColaborador').select2({
            placeholder: "Seleccione el colaborador",
            allowClear: true,
            width: 'auto'
    });

	$('#guardar').click(function() {

		if (formulario.checkValidity()) {
			$.ajax({
				type: "POST",
				url: "{{url('medicion/update')}}",
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
