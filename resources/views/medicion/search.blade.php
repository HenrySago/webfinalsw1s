<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th> # </th>
                <th> Mensualidad </th>
                <th> Cliente </th>
                <th> Perfil </th>
                <th> Referencia </th>
                <th> Direccion </th>
                <th> Colaborador </th>
                <th> Administrador </th>
                <th> Estado </th>
                <th> Consumo lecturado (m3) </th>
                <th> Consumo real (m3) </th>
                <th> Total (bs) </th>
                <th> Opciones </th>
            </tr>
        </thead>
        <tbody>
            @foreach($mediciones as $item)
            <tr >
                <td style="vertical-align: middle;">  {{$item->id}} </td>
                <td style="vertical-align: middle;"> {{$item->mensualidad->nombre}} {{$item->mensualidad->gestion->nombre}} </td>
                <td style="vertical-align: middle;"> {{$item->cliente->nombres}} {{$item->cliente->apellidos}}</td>
                <td style="vertical-align: middle;"> 
                    <img src="{{asset($item->cliente->perfil)}}" alt="perfil" style="width: 70px; height: 70px;border-radius: 100% !important;object-fit: contain;">
                </td>
                <td style="vertical-align: middle;"> {{$item->referencia}} </td>
                <td style="vertical-align: middle;">  {{$item->direccion}} </td>
                <td style="vertical-align: middle;"> {{$item->colaborador->nombres}} {{$item->colaborador->apellidos}} </td>
                <td style="vertical-align: middle;"> {{$item->administrador->name}} </td>
                <td style="vertical-align: middle;"> 
                    @if($item->estado==1)
                    <span style="width: 100%;padding: 3px;background-color: green;color: white">Medido</span>
                    @else
                    <span style="width: 100%;padding: 3px;background-color: red;color: white">Sin medir</span>
                    @endif  
                </td>
                <td style="vertical-align: middle;"> {{$item->consumo}}</td>
                <td style="vertical-align: middle;"> {{$item->consumoReal}}</td>
                <td style="vertical-align: middle;"> {{$item->total}}</td>

                <td style="vertical-align: middle;">       
                    <a href="{{url('medicion/'.$item->id)}}" class="btn btn-icon-only default round">
                        <i class="fa fa-eye"></i>
                    </a>   
                    <a href="{{url('medicion/'.$item->id.'/edit')}}" class="btn btn-icon-only orange round">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{url('reporte/reporteMedicion/'.$item->id)}}" target="_blank" class="btn btn-icon-only red round">
                        <i class="fa fa-print"></i>
                    </a>   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
