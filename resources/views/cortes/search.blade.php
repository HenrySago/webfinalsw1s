<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th> # </th>
                <th> Nombres </th>
                <th> Apellidos </th>
                <th> Perfil </th>
                <th> Ci </th>
                <th> Celular </th>
                <th> Email </th>
                <th> Estado </th>
                <th> Opciones </th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $item)
            <tr >
                <td style="vertical-align: middle;">  {{$item->id}} </td>
                <td style="vertical-align: middle;"> {{$item->nombres}}</td>
                <td style="vertical-align: middle;"> {{$item->apellidos}}</td>
                <td style="vertical-align: middle;"> 
                    <img src="{{asset($item->perfil)}}" alt="perfil" style="width: 70px; height: 70px;border-radius: 100% !important;object-fit: contain;">
                </td>
                <td style="vertical-align: middle;">  {{$item->ci}} </td>
                <td style="vertical-align: middle;">  {{$item->celular}} </td>
                <td style="vertical-align: middle;"> {{$item->email}} </td>
                <td style="vertical-align: middle;"> 
                    @if($item->desabilitado==0)
                    <span style="width: 100%;padding: 3px;background-color: green;color: white">Habilitado</span>
                    @else
                    <span style="width: 100%;padding: 3px;background-color: red;color: white">Desabilitado</span>
                    @endif  
                </td>
                <td style="vertical-align: middle;">       
                        <a href="{{url('cliente/'.$item->id)}}" class="btn btn-icon-only default round">
                            <i class="fa fa-eye"></i>
                        </a>   
                        <a href="{{url('cliente/'.$item->id.'/edit')}}" class="btn btn-icon-only orange round">
                            <i class="fa fa-edit"></i>
                        </a>    
                        @if($item->desabilitado==0)
                        <a  class="btn btn-icon-only red round" data-target="#estadoCliente{{$item->id}}" data-toggle="modal">
                            <i class="fa fa-thumbs-down"></i>
                        </a>
                        @else
                        <a  class="btn btn-icon-only blue round" data-target="#estadoCliente{{$item->id}}" data-toggle="modal">
                            <i class="fa fa-thumbs-up"></i>
                        </a>
                        @endif  
                        <a  class="btn btn-icon-only red round" data-target="#cliente{{$item->id}}" data-toggle="modal">
                            <i class="fa fa-times"></i>
                        </a>
                        @include('cliente.modal-estado')
                        @include('cliente.modal-delete')
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
	{{ $clientes->links() }}
</div>