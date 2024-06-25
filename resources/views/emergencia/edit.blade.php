@extends('layout.panel')

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('dashboard')}}">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('cliente')}}">Listado de clientes</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Editar emergencia</span>
        </li>
    </ul>
</div>
@endsection

@section('content')

<h3 class="page-title"> Editar cliente con nombre <strong>{{$cliente->nombres}}</strong>
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
        <input type="hidden" name="id" value="{{ $cliente->id }}">



     	<div class="form-row">
            <div class="form-group col-md-6">
                <label>Nombres <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="nombres" name="nombres" class="form-control form-control-sm" placeholder="Nombres" required="" value="{{$cliente->nombres}}">
            </div>
            <div class="form-group col-md-6">
                <label>Apellidos <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="apellidos" name="apellidos" class="form-control form-control-sm" placeholder="Apellidos" required="" value="{{$cliente->apellidos}}">
            </div>       
        </div>
 
     	<div class="form-row">
            <div class="form-group col-md-6">
                <label>Celular <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="celular" name="celular" class="form-control form-control-sm" placeholder="Celular" required="" value="{{$cliente->celular}}">
            </div>
            <div class="form-group col-md-6">
                <label>Ci <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="ci" name="ci" class="form-control form-control-sm" placeholder="Ci" required="" value="{{$cliente->ci}}">
            </div>     
        </div>
 
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Nit <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="nit" name="nit" class="form-control form-control-sm" placeholder="Nit" required="" value="{{$cliente->nit}}">
            </div>
            <div class="form-group col-md-6">
                <label>Nombre factura <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="nombreFactura" name="nombreFactura" class="form-control form-control-sm" placeholder="Nombre factura" required="" value="{{$cliente->nombreFactura}}">
            </div>     
        </div>
     	<div class="form-row">
            <div class="form-group col-md-6">
                <label>Direccion <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="direccion" name="direccion" class="form-control form-control-sm" placeholder="Direccion" required="" value="{{$cliente->direccion}}">
            </div>
            <div class="form-group col-md-6">
                <label>Referencia <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="referencia" name="referencia" class="form-control form-control-sm" placeholder="Referencia" required="" value="{{$cliente->referencia}}">
            </div>     
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Seleccione la ubicación precisa del domicilio <strong class="required" aria-required="true">*</strong></label>
                <div id="mapa" style="height: 400px; width: auto;"></div>
            </div>
        </div>
		<input type="hidden" id="latitud" name="latitud" value="{{$cliente->latitud}}">
		<input type="hidden" id="longitud" name="longitud" value="{{$cliente->longitud}}">

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="single-append-text" class="control-label">Seleccione la ciudad <strong class="required" aria-required="true">*</strong></label>
                <select class="js-example-basic-single" id="idCiudad" name="idCiudad">
                    <option></option>
                    @foreach($ciudades as $item)
                    	@if($cliente->idCiudad==$item->id)
                        <option value="{{$item->id}}" selected="">{{$item->nombre}}</option>
                        @else
                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

      	<div class="form-row">
            <div class="form-group col-md-6">
                <label>Email <strong class="required" aria-required="true">*</strong></label>
                <input type="email" id="email" name="email" class="form-control form-control-sm" placeholder="Nombre" required="" value="{{$cliente->email}}">
            </div>
             <div class="form-group col-md-6">
                <label>Password</label>
                <input type="password" id="password" name="password" class="form-control form-control-sm" placeholder="Password">
            </div>         
        </div>
 

     	<div class="form-row">
          	<div class="form-group col-md-12">
              <label>Perfil <strong class="required" aria-required="true">*</strong></label>
              <div class="image-upload-wrap">
                <input class="file-upload-input" type='file' name="perfil" onchange="readURL(this);" accept="image/jpg, image/jpeg,image/png"/>
                <div class="drag-text">
                  <h3>Arrastra la imagen o selecciona</h3>
                </div>
              </div>
              <div class="file-upload-content">
                <img class="file-upload-image" src="#" alt="perfil" />
                <div class="image-title-wrap">
                  <button type="button" onclick="removeUpload()" class="remove-image">Eliminar</button>
                </div>
              </div>
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
<script src="https://maps.googleapis.com/maps/api/js?key={{$gmpasKey}}"></script>

<script>
$(document).ready(function(){
	$('#navCooperativa').addClass('active open');
    $('#navCooperativa span.arrow').addClass('open');
	$('#itemCliente').addClass('active open');


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
        mapa.addListener('click', function (e) {
            posicionarMarcador(e.latLng, mapa);
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

    $('#idCiudad').select2({
            placeholder: "Seleccione la ciudad",
            allowClear: true,
            width: 'auto'
    });

    var cliente = {!! json_encode($cliente) !!};
   

    var perfil = cliente.perfil;
    if (perfil!=null) {
        perfil = perfil.substring(1,perfil.length);
        $('.file-upload-image').attr('src',`{{asset('`+perfil+`')}}`);
        $('.image-upload-wrap').hide();
        $('.file-upload-content').show();
    }

	$('#guardar').click(function() {

		if (formulario.checkValidity()) {
			$.ajax({
				type: "POST",
				url: "{{url('cliente/update')}}",
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

						setTimeout(function(){window.location = "/cliente"} , 2000);   

						
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
