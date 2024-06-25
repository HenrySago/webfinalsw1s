<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th> # </th>
                <th> Mensualidad </th>
                <th> Cliente </th>
                <th> Referencia </th>
                <th> Direccion </th>
                <th> Estado </th>
                <th> Consumo lecturado (m3) </th>
                <th> Consumo real (m3) </th>
                <th> Total (bs) </th>
                <th> Opciones </th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $item)
            <tr >
                <td style="vertical-align: middle;">  {{$item->id}} </td>
                <td style="vertical-align: middle;"> {{$item->medicion->mensualidad->nombre}} {{$item->medicion->mensualidad->gestion->nombre}} </td>
                <td style="vertical-align: middle;"> {{$item->medicion->cliente->nombres}} {{$item->medicion->cliente->apellidos}}</td>
                <td style="vertical-align: middle;"> {{$item->medicion->referencia}} </td>
                <td style="vertical-align: middle;">  {{$item->medicion->direccion}} </td>
                <td style="vertical-align: middle;"> 
                    @if($item->pagado==1)
                    <span style="width: 100%;padding: 3px;background-color: green;color: white">Pagado</span>
                    @else
                    <span style="width: 100%;padding: 3px;background-color: red;color: white">No pagado</span>
                    @endif  
                </td>
                <td style="vertical-align: middle;"> {{$item->medicion->consumo}}</td>
                <td style="vertical-align: middle;"> {{$item->medicion->consumoReal}}</td>
                <td style="vertical-align: middle;"> {{$item->medicion->total}}</td>

                <td style="vertical-align: middle;">       
                        <a href="{{url('factura/'.$item->id)}}" class="btn btn-icon-only default round">
                            <i class="fa fa-eye"></i>
                        </a> 
                        <a href="{{url('reporte/reporteFactura/'.$item->id)}}" target="_blank" class="btn btn-icon-only red round">
                            <i class="fa fa-print"></i>
                        </a>   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>