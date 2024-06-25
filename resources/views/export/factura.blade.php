<table >
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
        </tr>
    </thead>
    <tbody>
        @foreach($facturas as $item)
        <tr >
            <td>  {{$item->id}} </td>
            <td> {{$item->medicion->mensualidad->gestion->nombre}} {{$item->medicion->mensualidad->nombre}} </td>
            <td> {{$item->medicion->cliente->nombres}} {{$item->medicion->cliente->apellidos}}</td>
            <td> {{$item->medicion->referencia}} </td>
            <td>  {{$item->medicion->direccion}} </td>
            <td> 
                @if($item->pagado==1)
                Pagado
                @else
                No pagado
                @endif  
            </td>
            <td> {{$item->medicion->consumo}}</td>
            <td> {{$item->medicion->consumoReal}}</td>
            <td> {{$item->medicion->total}}</td>
        </tr>
        @endforeach
    </tbody>
</table>