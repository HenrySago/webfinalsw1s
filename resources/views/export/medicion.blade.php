<table >
    <thead>
        <tr>
            <th> # </th>
            <th> Mensualidad </th>
            <th> Cliente </th>
            <th> Referencia </th>
            <th> Direccion </th>
            <th> Colaborador </th>
            <th> Administrador </th>
            <th> Estado </th>
            <th> Consumo lecturado (m3) </th>
            <th> Consumo real (m3) </th>
            <th> Total (bs) </th>
        </tr>
    </thead>
    <tbody>
        @foreach($mediciones as $item)
        <tr >
            <td>  {{$item->id}} </td>
            <td> {{$item->mensualidad->gestion->nombre}} {{$item->mensualidad->nombre}} </td>
            <td> {{$item->cliente->nombres}} {{$item->cliente->apellidos}}</td>
            <td> {{$item->referencia}} </td>
            <td>  {{$item->direccion}} </td>
            <td> {{$item->colaborador->nombres}} {{$item->colaborador->apellidos}} </td>
            <td> {{$item->administrador->name}} </td>
            <td> 
                @if($item->estado==1)
                Medido
                @else
                Sin medir
                @endif  
            </td>
            <td> {{$item->consumo}}</td>
            <td> {{$item->consumoReal}}</td>
            <td> {{$item->total}}</td>
        </tr>
        @endforeach
    </tbody>
</table>