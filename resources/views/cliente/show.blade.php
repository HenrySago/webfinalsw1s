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
            <span>Ver detalle de cliente</span>
        </li>
    </ul>
</div>
@endsection

@section('content')

<h3 class="page-title"> Ver detalle de cliente con nombres <strong>{{$cliente->nombres}}</strong>
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
                    <i class="fa fa-user colorwhite"></i>Datos del cliente </div>

            </div>
            <div class="portlet-body">
                <div class="row static-info">
                    <div class="col-md-6 name"> Nombres</div>
                    <div class="col-md-6 value"> {{$cliente->nombres}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Apellidos</div>
                    <div class="col-md-6 value"> {{$cliente->apellidos}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Celular</div>
                    <div class="col-md-6 value"> {{$cliente->celular}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Ci</div>
                    <div class="col-md-6 value"> {{$cliente->ci}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Email </div>
                    <div class="col-md-6 value"> {{$cliente->email}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Direccion</div>
                    <div class="col-md-6 value"> {{$cliente->direccion}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Referencia</div>
                    <div class="col-md-6 value"> {{$cliente->referencia}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Ciudad </div>
                    <div class="col-md-6 value"> {{$cliente->ciudad->nombre}}</div>
                </div>
                <div class="row static-info" >
                    <div class="col-md-6 name" > Perfil</div>
                    <div class="col-md-6 value"> <img src="{{asset($cliente->perfil)}}" alt="Fotografia" style="width: 70px;height: 70px;border-radius: 100% !important;">

                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Consumo inicial </div>
                    <div class="col-md-6 value"> {{$cliente->consumoInicial}}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="portlet box plomot">
            <div class="portlet-title">
                <div class="caption colorwhite">
                    <i class="fa fa-user colorwhite"></i>Ubicacion del cliente </div>
            </div>
            <div class="portlet-body">
                <div id="mapa" style="height: 400px; width: auto;"></div>
                <input type="hidden" id="latitud" name="latitud" value="{{$cliente->latitud}}">
                <input type="hidden" id="longitud" name="longitud" value="{{$cliente->longitud}}">
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