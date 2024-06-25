<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th> # </th>
                <th> Gestion </th>
                <th> Nombre </th>
                <th> Opciones </th>
            </tr>
        </thead>
        <tbody>
            @foreach($mensualidades as $item)
            <tr >
                <td style="vertical-align: middle;">  {{$item->id}} </td>
                <td style="vertical-align: middle;"> {{$item->gestion->nombre}}</td>
                <td style="vertical-align: middle;"> {{$item->nombre}}</td>
                <td style="vertical-align: middle;">       
                    <a href="{{url('mensualidad/'.$item->id)}}" class="btn btn-icon-only default round">
                        <i class="fa fa-eye"></i>
                    </a>   
                    <a href="{{url('mensualidad/'.$item->id.'/edit')}}" class="btn btn-icon-only orange round">
                        <i class="fa fa-edit"></i>
                    </a>    
                    <a  class="btn btn-icon-only red round" data-target="#mensualidad{{$item->id}}" data-toggle="modal">
                        <i class="fa fa-times"></i>
                    </a>
                    @include('mensualidad.modal-delete')
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
    {{ $mensualidades->links() }}
</div>