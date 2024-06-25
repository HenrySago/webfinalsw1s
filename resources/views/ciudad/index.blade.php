@extends('layout.panel')
@push('links')
<link href="{{asset('css/card-item.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('dashboard')}}">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Listado de ciudades</span>
        </li>
    </ul>
</div>
@endsection

@section('content')
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<h3 class="page-title"> Listado de ciudades
    <!-- <small>material design form inputs, checkboxes and radios</small> -->
</h3>

<div class="row" >
    <div class="form-group col-md-1">
        <a class="btn sbold plomo" href="{{url('dashboard')}}"> Atras
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>
    <div class="form-group col-md-1">
        <a class="btn sbold orange" href="{{url('ciudad/create')}}"> Nuevo
            <i class="fa fa-plus"></i>
        </a>
    </div>
</div>	

<div class="portlet-body">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
              <tr>
                <th>
                  <a class="btn btn-icon-only default round">
                    <i class="fa fa-eye"></i> 
                  </a>   
                  Ver                   
                </th>
                <th>
                  <a class="btn btn-icon-only orange round">
                    <i class="fa fa-edit"></i> 
                  </a>
                  Editar                  
                </th>
                <th>
                  <a class="btn btn-icon-only red round">
                    <i class="fa fa-times"></i> 
                  </a>
                  Eliminar                  
                </th>
              </tr>
            </thead>
        </table>
    </div>
</div>  

<div class="container">
	@foreach($ciudades as $item)
	  <div class="cards">
	    <div class="card-item">
        <div class="card-image"  onclick="show('{{$item->id}}');">
        </div>
	      <div class="card-info">
	        <h2 class="card-title"><strong>{{$item->nombre}}</strong></h2>
            <h2 class="card-title"><strong>{{$item->tarifa}} Bs x m3</strong></h2>
            <h2 class="card-title"><strong>{{$item->digitosEnterosMedidor}} digitos enteros</strong></h2>
            <h2 class="card-title"><strong>{{$item->digitosDecimalesMedidor}} digitos decimales</strong></h2>
	        <div style="margin: 1em;text-align: center;">    	    
		        <a href="{{url('ciudad/'.$item->id)}}" class="btn btn-icon-only default round">
	                <i class="fa fa-eye"></i>
	            </a>   
	    		<a href="{{url('ciudad/'.$item->id.'/edit')}}" class="btn btn-icon-only orange round">
	                <i class="fa fa-edit"></i>
	            </a>
	    		<a  class="btn btn-icon-only red round" data-target="#ciudad{{$item->id}}" data-toggle="modal">
	                <i class="fa fa-times"></i>
	            </a>
        	</div>
            @include('ciudad.modal-delete')
	      </div>
	    </div>
	  </div>
	@endforeach
</div>

<footer>
<a href="">contador de visitas 45</a>
</footer>
@endsection

@push('scripts')
<script src="{{asset('js/jquery.blockUI.js')}}" type="text/javascript"></script>  
<script>
$(document).ready(function(){

$('#navAdministracion').addClass('active open');
$('#navAdministracion span.arrow').addClass('open');
$('#itemCiudad').addClass('active open');

	var ciudades = {!! json_encode($ciudades) !!};
	$('div.card-image').each(function(i) {
		var bandera = ciudades[i].bandera.substring(1,ciudades[i].bandera.length);
		//console.log(imagen);
	 	return $(this).css('background-image', `url({{asset('`+bandera+`')}})`);
	});


	show = function(idciudad)
	{
		window.location = "/ciudad/"+idciudad;
	};

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('input[name="_token"]').val()
      }
    });

    eliminar = function (id){
      var idTipoVehiculo = id;
      $.ajax({
        type: "POST",
        url: "{{url('ciudad/delete')}}",
        data: {id: idTipoVehiculo},
        success: function( response ) {
          if (response.codigo==0) {
          
            toastr.success(response.mensaje, 'Satisfactorio!');
                  toastr.options.closeDuration = 10000;
            toastr.options.timeOut = 10000;
            toastr.options.extendedTimeOut = 10000;
            setTimeout(function(){window.location = "/ciudad"} , 1000);   

          }else{

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
    }



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
