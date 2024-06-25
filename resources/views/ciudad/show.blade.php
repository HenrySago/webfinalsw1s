@extends('layout.panel')
@push('links')
<link href="{{asset('css/card.css')}}" rel="stylesheet" type="text/css" />
<style>
.flip {
  position: relative;
}
.flip > .front, .flip > .back {
  display: block;
  transition-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1.275);
  transition-duration: 1s;
  transition-property: transform, opacity;
}
.flip > .front {
  transform: rotateY(0deg);
}
.front{
  border-radius: 9px !important;
  margin-left: 10px;
}
.flip > .back {
  position: absolute;
  opacity: 0;
  top: 0px;
  left: 0px;
  width: 100%;
  height: 100%;
  transform: rotateY(-180deg);
}
/*.flip:hover > .front {
  transform: rotateY(180deg);
}
.flip:hover > .back {
  opacity: 1;
  transform: rotateY(0deg);
}*/
.flip.flip-vertical > .back {
  transform: rotateX(-180deg);
}
/*.flip.flip-vertical:hover > .front {
  transform: rotateX(180deg);
}
.flip.flip-vertical:hover > .back {
  transform: rotateX(0deg);
}*/
.flip {
  position: relative;
  display: inline-block;
  margin-right: 2px;
  margin-bottom: 1em;
  margin-top: 6px;
  width: auto;
}
.flip > .front, .flip > .back {
  display: block;
  color: white;
  width: 123px;
  background-size: cover !important;
  background-position: center !important;
  height: 123px;
  padding: 1em 2em;
  background: #eacbb0;
  border-radius: 10px;
}
.flip > .front p, .flip > .back p {
    font-size: 14px;
    line-height: 160%;
    color: #7b7575;
    font-weight: 500;
    white-space: nowrap;
    width: auto;
    overflow: hidden;
    text-overflow: ellipsis;
}
.text-shadow {
  text-shadow: 1px 1px rgba(0, 0, 0, 0.04), 2px 2px rgba(0, 0, 0, 0.04), 3px 3px rgba(0, 0, 0, 0.04), 4px 4px rgba(0, 0, 0, 0.04), 0.125rem 0.125rem rgba(0, 0, 0, 0.04), 6px 6px rgba(0, 0, 0, 0.04);
    font-size: 16px;
    font-weight: 800;
}

.back h2{
  text-shadow: 1px 1px rgba(0, 0, 0, 0.04), 2px 2px rgba(0, 0, 0, 0.04), 3px 3px rgba(0, 0, 0, 0.04), 4px 4px rgba(0, 0, 0, 0.04), 0.125rem 0.125rem rgba(0, 0, 0, 0.04), 6px 6px rgba(0, 0, 0, 0.04);
    font-size: 31px;
    font-weight: 800;
}
#tablePoligonos::-webkit-scrollbar {
  width: 10px;
}
 
#tablePoligonos::-webkit-scrollbar-thumb {
  border-radius: 3px;
  box-shadow: inset 0 0 6px rgba(0,0,0,.3);
  background-color: #e97a33;
  border: 1px solid white;
}

#tablePoligonos::-webkit-scrollbar-thumb:hover {
  background: #e97a33;
}
.table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
    border-top: 0;
    text-align: center;
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
            <span>Ver detalle de la ciudad</span>
        </li>
    </ul>
</div>
@endsection

@section('content')
<h3 class="page-title"> Ver detalle de la ciudad: <strong>{{$ciudad->nombre}}</strong>
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


<div class="row" >	
    <div class="col-md-12" style="text-align: center;">
      <div class="row col-md-12" style="margin-bottom: 1em;">
        <img src="{{asset($ciudad->bandera)}}" alt="bandera" style="width: 120px;height: 70px;border-radius: 10px !important;">
        <strong style="vertical-align: middle;font-size: 32px;">{{$ciudad->nombre}}</strong>        
      </div>
      <div class="row col-md-12" style="margin-bottom: 1em;">
        <strong style="vertical-align: middle;font-size: 22px;">Tarifa: {{$ciudad->tarifa}} Bs.</strong>        
      </div>
      <div class="row col-md-12" style="margin-bottom: 1em;">
        <strong style="vertical-align: middle;font-size: 22px;">Digitos enteros del medidor: {{$ciudad->digitosEnterosMedidor}} </strong>        
      </div>
      <div class="row col-md-12" style="margin-bottom: 1em;">
        <strong style="vertical-align: middle;font-size: 22px;">Digitos decimales del medidor: {{$ciudad->digitosDecimalesMedidor}}</strong>        
      </div>
    </div>  
      
</div>



@endsection 

@push('scripts')
<script src="{{asset('js/jquery.blockUI.js')}}" type="text/javascript"></script> 
<script>

  

</script>
@endpush