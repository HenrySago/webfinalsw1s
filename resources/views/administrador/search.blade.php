<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th> # </th>
                <th> Nombre </th>
                <th> Perfil </th>
                <th> Ci </th>
                <th> Email </th>
                <th> Estado </th>
                <th> Opciones </th>
            </tr>
        </thead>
        <tbody>
        	@foreach($administradores as $item)
            <tr >
                <td style="vertical-align: middle;">  {{$item->id}} </td>
                <td style="vertical-align: middle;"> {{$item->name}}</td>
                <td style="vertical-align: middle;"> 
                	<img src="{{asset($item->perfil)}}" alt="perfil" style="width: 70px; height: 70px;border-radius: 100% !important;object-fit: contain;">
                </td>
                <td style="vertical-align: middle;">  {{$item->ci}} </td>
                <td style="vertical-align: middle;"> {{$item->email}} </td>
                <td style="vertical-align: middle;"> 
                    @if($item->desabilitado==0)
                    <span style="width: 100%;padding: 3px;background-color: green;color: white">Habilitado</span>
                    @else
                    <span style="width: 100%;padding: 3px;background-color: red;color: white">Desabilitado</span>
                    @endif  
                </td>
                <td style="vertical-align: middle;">       
                	    <a href="{{url('administrador/'.$item->id)}}" class="btn btn-icon-only default round">
                            <i class="fa fa-eye"></i>
                        </a>   
                		<a href="{{url('administrador/'.$item->id.'/edit')}}" class="btn btn-icon-only orange round">
                            <i class="fa fa-edit"></i>
                        </a>	
                        @if($item->desabilitado==0)
                        <a  class="btn btn-icon-only red round" data-target="#estadoAdministrador{{$item->id}}" data-toggle="modal">
                            <i class="fa fa-thumbs-down"></i>
                        </a>
                        @else
                        <a  class="btn btn-icon-only blue round" data-target="#estadoAdministrador{{$item->id}}" data-toggle="modal">
                            <i class="fa fa-thumbs-up"></i>
                        </a>
                        @endif  
                        @include('administrador.modal-estado')
                        @include('administrador.modal-delete')
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
	{{ $administradores->links() }}
</div>