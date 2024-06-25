@extends('layout.panel')

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('dashboard')}}">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('cliente')}}">Listado de emergencia</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Ver detalle de emergencia</span>
        </li>
    </ul>
</div>
@endsection

@section('content')

<h3 class="page-title"> Ver detalle de emergencia <strong>{{$emergencia->nombre}}</strong>
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
<div class="row" >	
    <div class="col-md-6 col-sm-12">
        <div class="portlet box plomot">
            <div class="portlet-title">
                <div class="caption colorwhite">
                    <i class="fa fa-user colorwhite"></i>Datos de la emergencia </div>

            </div>
            <div class="portlet-body">
                <div class="row static-info">
                    <div class="col-md-6 name"> Nombres</div>
                    <div class="col-md-6 value"> {{$emergencia->nombre}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Descripcion</div>
                    <div class="col-md-6 value"> {{$emergencia->descripcion}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> id_tec</div>
                    <div class="col-md-6 value"> {{$emergencia->id_tec}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> id_cli</div>
                    <div class="col-md-6 value"> {{$emergencia->id_cli}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> id_zon </div>
                    <div class="col-md-6 value"> {{$emergencia->id_zon}}</div>
                </div>
            </div>
        </div>
    </div>




</div>
@endsection  
@push('scripts')
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
});


</script>
@endpush