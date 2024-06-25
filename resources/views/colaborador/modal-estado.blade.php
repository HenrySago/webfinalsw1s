<div id="estadoColaborador{{$item->id}}" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-keyboard="false">
    <div class="modal-body">
		@if($item->inhabilitado==0)
        <p> ¿ Esta seguro de <strong>inhabilitar</strong> al colaborador con nombre <strong>{{$item->nombres}} {{$item->apellidos}}</strong> ? </p>
        @else
        <p> ¿ Esta seguro de <strong>habilitar</strong> al colaborador con nombre <strong>{{$item->nombres}} {{$item->apellidos}}</strong> ? </p>
        @endif
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn plomo">Cancelar</button>
        @if($item->inhabilitado==0)
        	<button type="button" data-dismiss="modal" class="btn orange" onclick="cambiarEstadoColaborador('{{$item->id}}');" >Inhabilitar</button>
        @else
        	<button type="button" data-dismiss="modal" class="btn orange" onclick="cambiarEstadoColaborador('{{$item->id}}');" >Habilitar</button>
        @endif
    </div>
</div>
@push('scripts')     
<script>
$(document).ready(function(){



	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('input[name="_token"]').val()
		}
	});


	cambiarEstadoColaborador = function (id){
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
		var idColaborador = id;
		$.ajax({
			type: "POST",
			url: "{{url('colaborador/estado')}}",
			data: {id: idColaborador},
			success: function( response ) {
    			$.unblockUI();

				if (response.codigo==0) {
				
					toastr.success(response.mensaje, 'Satisfactorio!');
		           	toastr.options.closeDuration = 10000;
					toastr.options.timeOut = 10000;
					toastr.options.extendedTimeOut = 10000;
					setTimeout(function(){window.location = window.location} , 1000);   

				}else{

					toastr.error(response.mensaje, 'Ocurrio un error!');
		           	toastr.options.closeDuration = 10000;
					toastr.options.timeOut = 10000;
					toastr.options.extendedTimeOut = 10000;
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
    			$.unblockUI();
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
