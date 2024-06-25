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
            <span>Ver detalle de medicion</span>
        </li>
    </ul>
</div>
@endsection

@section('content')

<h3 class="page-title"> Ver detalle de medicion con # <strong>{{$medicion->id}}</strong>
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
<div class="row" >	
    <div class="col-md-6 col-sm-12">
        <div class="portlet box plomot">
            <div class="portlet-title">
                <div class="caption colorwhite">
                    <i class="fa fa-user colorwhite"></i>Datos de la medicion </div>

            </div>
            <div class="portlet-body">
                <div class="row static-info">
                    <div class="col-md-6 name"> Mensualidad</div>
                    <div class="col-md-6 value"> {{$medicion->mensualidad->nombre}} {{$medicion->mensualidad->gestion->nombre}} </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Consumo lecturado (m3) </div>
                    <div class="col-md-6 value"> {{$medicion->consumo}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Consumo real (m3) </div>
                    <div class="col-md-6 value"> {{$medicion->consumoReal}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Total (bs) </div>
                    <div class="col-md-6 value"> {{$medicion->total}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Estado </div>
                    <div class="col-md-6 value"> 
                        @if($medicion->estado==1)
                        <span style="width: 100%;padding: 3px;background-color: green;color: white">Medido</span>
                        @else
                        <span style="width: 100%;padding: 3px;background-color: red;color: white">Sin medir</span>
                        @endif 

                    </div>
                </div>
 
                <div class="row static-info">
                    <div class="col-md-6 name"> Cliente</div>
                    <div class="col-md-6 value"> {{$medicion->cliente->nombres}} {{$medicion->cliente->apellidos}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Referencia</div>
                    <div class="col-md-6 value"> {{$medicion->referencia}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Direccion</div>
                    <div class="col-md-6 value"> {{$medicion->direccion}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Colaborador </div>
                    <div class="col-md-6 value"> {{$medicion->colaborador->nombres}} {{$medicion->colaborador->apellidos}} </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Administrador</div>
                    <div class="col-md-6 value"> {{$medicion->administrador->name}}</div>
                </div>
                <div class="row static-info">
                    <div class="col-md-6 name"> Ciudad </div>
                    <div class="col-md-6 value"> {{$medicion->cliente->ciudad->nombre}} </div>
                </div>
                <div class="row static-info" >
                    <div class="col-md-6 name" > Perfil</div>
                    <div class="col-md-6 value"> <img src="{{asset($medicion->cliente->perfil)}}" alt="Fotografia" style="width: 70px;height: 70px;border-radius: 100% !important;">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="portlet box plomot">
            <div class="portlet-title">
                <div class="caption colorwhite">
                    <i class="fa fa-user colorwhite"></i>Ubicacion de la medicion </div>
            </div>
            <div class="portlet-body">
                <div id="mapa" style="height: 400px; width: auto;"></div>
                <input type="hidden" id="latitud" name="latitud" value="{{$medicion->latitud}}">
                <input type="hidden" id="longitud" name="longitud" value="{{$medicion->longitud}}">
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
});


</script>
@endpush