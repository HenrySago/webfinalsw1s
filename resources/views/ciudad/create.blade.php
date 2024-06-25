@extends('layout.panel')
@push('links')
<style>
    .gm-style img:not([role~="presentation"]) {
        border-radius: 20px !important;
    }
    [role~="presentation"]{
       border-radius: 0px !important;    
    }   
    .delete-menu {
        position: absolute;
        background: red;
        padding: 10px;
        color: white;
        font-weight: bold;
        border: 1px solid #999;
        font-family: sans-serif;
        font-size: 12px;
        box-shadow: 1px 3px 3px rgba(0, 0, 0, .3);
        margin-top: -10px;
        margin-left: 10px;
        cursor: pointer;
    }
</style>
@endpush
@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('dashboard')}}">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('ciudad')}}">Listado de ciudades</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Nueva ciudad</span>
        </li>
    </ul>
</div>
@endsection

@section('content')

<h3 class="page-title"> Nueva ciudad
</h3>

<div class="row" >	
		<div class="col-md-1" style="margin-bottom: 1em;">
	        <div class="btn-group">
	            <a class="btn sbold plomo" href="{{url('ciudad')}}"> Volver al listado
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
                <label>Nombre <strong class="required" aria-required="true">*</strong></label>
                <input type="text" id="nombre" name="nombre" class="form-control form-control-sm" placeholder="Nombre" required="">
            </div>
            <div class="form-group col-md-6">
                <label>Tarifa por m3<strong class="required" aria-required="true">*</strong></label>
                <input type="number" id="tarifa" name="tarifa" class="form-control form-control-sm" placeholder="Tarifa" required="">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Digitos enteros del medidor <strong class="required" aria-required="true">*</strong></label>
                <input type="number" id="digitosEnterosMedidor" name="digitosEnterosMedidor" class="form-control form-control-sm" placeholder="Digitos enteros del medidor" required="">
            </div>
            <div class="form-group col-md-6">
                <label>Digitos decimales del medidor<strong class="required" aria-required="true">*</strong></label>
                <input type="number" id="digitosDecimalesMedidor" name="digitosDecimalesMedidor" class="form-control form-control-sm" placeholder="Digitos decimales del medidor" required="">
            </div>
        </div>
 

     	<div class="form-row">
          	<div class="form-group col-md-12">
              <label>Bandera <strong class="required" aria-required="true">*</strong></label>
              <div class="image-upload-wrap">
                <input class="file-upload-input" type='file' name="bandera" onchange="readURL(this);" accept="image/jpg, image/jpeg,image/png" required=""/>
                <div class="drag-text">
                  <h3>Arrastra la imagen o selecciona</h3>
                </div>
              </div>
              <div class="file-upload-content">
                <img class="file-upload-image" src="#" alt="bandera" />
                <div class="image-title-wrap">
                  <button type="button" onclick="removeUpload()" class="remove-image">Eliminar</button>
                </div>
              </div>
          	</div>
	     </div>


        <div class="form-body col-md-12" style="margin-top: 1em;">
            <a  id="guardar" class="btn orange">Guardar</a>
            <a type="button" href="{{url('ciudad')}}" class="btn plomo">Cancelar</a>
        </div>


    </form>


</div>

@endsection  
@push('scripts')     
<script src="{{asset('js/jquery.blockUI.js')}}" type="text/javascript"></script>  
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjdMOrxzeavM10XqfyrPB21N5kZAoKQQk"></script>
<script>

	var formulario = document.getElementById('formulario');

	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('input[name="_token"]').val()
		}
	});


	$('#guardar').click(function() {

		if (formulario.checkValidity()) {

            var data = new FormData($("#formulario")[0]);
            $.ajax({
                type: "POST",
                url: "{{url('ciudad/create')}}",
                data: data,
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

                        setTimeout(function(){window.location = "/ciudad"} , 2000);   

                        
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