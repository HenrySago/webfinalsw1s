@extends('layout.panel')

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('dashboard')}}">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Listado de mensualidades</span>
        </li>
    </ul>
</div>
@endsection

@section('content')
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<h3 class="page-title"> Listado de mensualidades
    <!-- <small>material design form inputs, checkboxes and radios</small> -->
</h3>

<div class="row" >
    <div class="form-group col-md-1">
        <a class="btn sbold plomo" href="{{url('dashboard')}}"> Atras
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>
    <div class="form-group col-md-1">
        <a class="btn sbold orange" href="{{url('mensualidad/create')}}"> Nuevo
            <i class="fa fa-plus"></i>
        </a>
    </div>
</div>	

<div class="portlet-body">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            	<tr>
            		<th style="width: 33.3%;">
						<a class="btn btn-icon-only default round">
							<i class="fa fa-eye"></i> 
						</a>   
						Ver	            			
            		</th>
            		<th style="width: 33.3%;">
						<a class="btn btn-icon-only orange round">
							<i class="fa fa-edit"></i> 
						</a>
						Editar            			
            		</th>
				    <th style="width: 33.3%;">
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

<div class="row">
    <div class="form-group col-md-6">
    	<label class="control-label">Busqueda </label>
		<input type="text" id="buscador" name="buscador" class="form-control form-control-sm" placeholder="Buscar">
	</div>

  	<div class="form-group col-md-6">
        <label class="control-label">Parametro de busqueda </label>
			<select class="form-control form-control-sm" id="parametroBusqueda" name="parametroBusqueda" >
		  			<option value="nombre">Nombre</option>
            </select>
    </div>
</div>

<div class="row">
 	<div class="col-md-12">
            
	    <div class="portlet box oranget">
	        <div class="portlet-title">
	            <div class="caption colorwhite">
	                <i class="fa fa-user colorwhite"></i>Listado de mensualidades </div>
	        </div>


	        <div class="portlet-body" id="cuerpo">
	            <div class="table-responsive">
	                <table class="table table-hover">
	                    <thead>
	                        <tr>
	                            <th> # </th>
	                            <th> Gestion </th>
	                            <th> Nombre </th>
	                            <th> Opciones </th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@foreach($mensualidades as $item)
	                        <tr >
	                            <td style="vertical-align: middle;">  {{$item->id}} </td>
	                            <td style="vertical-align: middle;"> {{$item->gestion->nombre}}</td>
	                            <td style="vertical-align: middle;"> {{$item->nombre}}</td>
	                            <td style="vertical-align: middle;">       
                            	    <a href="{{url('mensualidad/'.$item->id)}}" class="btn btn-icon-only default round">
                                        <i class="fa fa-eye"></i>
                                    </a>   
                            		<a href="{{url('mensualidad/'.$item->id.'/edit')}}" class="btn btn-icon-only orange round">
                                        <i class="fa fa-edit"></i>
                                    </a>	
						    		<a  class="btn btn-icon-only red round" data-target="#mensualidad{{$item->id}}" data-toggle="modal">
						                <i class="fa fa-times"></i>
						            </a>
                                    @include('mensualidad.modal-delete')
                                </td>
	                        </tr>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	            <div>
	        		{{ $mensualidades->links() }}
	            </div>
	        </div>


	    </div>
	</div>

</div>


@endsection
@push('scripts')     
<script>
$(document).ready(function(){

    $('#navAdministracion').addClass('active open');
    $('#navAdministracion span.arrow').addClass('open');
    $('#itemMensualidad').addClass('active open');

	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('input[name="_token"]').val()
		}
	});


    $('#buscador').keyup(function(e) {
        var busqueda = $('#buscador').val();
        var parametro = $('#parametroBusqueda').val();
        //console.log(busqueda);
        //console.log(parametro);

        busqueda = busqueda.trim();
		$.ajax({
			type: "GET",
			url: "{{url('mensualidad/search')}}",
			data: {valor:busqueda, parametro: parametro},
			success: function( response ) {
				$('#cuerpo').html(response);
			},
			error: function (xhr, ajaxOptions, thrownError) {
			}
		});
    });

    $(document).on('click','.pagination a', function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        paginar(page,$('#buscador').val(),$('#parametroBusqueda').val());
    });

    function paginar(page,busqueda, parametro){
        var url = "{{url('mensualidad/search')}}";
        $.ajax({
            type : 'GET',
            url : url+'?page='+page,
            data : {valor:busqueda, parametro: parametro},
        }).done(function(response){
            $('#cuerpo').html(response);
        })
    }

    eliminar = function (id){
      var idGestion = id;
      $.ajax({
        type: "POST",
        url: "{{url('mensualidad/delete')}}",
        data: {id: idGestion},
        success: function( response ) {
          if (response.codigo==0) {
          
            toastr.success(response.mensaje, 'Satisfactorio!');
                  toastr.options.closeDuration = 10000;
            toastr.options.timeOut = 10000;
            toastr.options.extendedTimeOut = 10000;
            setTimeout(function(){window.location = "/mensualidad"} , 1000);   

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




</script>
@endpush