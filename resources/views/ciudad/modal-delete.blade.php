<div id="ciudad{{$item->id}}" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-backdrop="ciudad{{$item->id}}" data-keyboard="false">
    <div class="modal-body">
        <p> ¿ Esta seguro de eliminar la ciudad con nombre  <strong>{{$item->nombre}}</strong> ? </p>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn plomo">Cancelar</button>
        <button type="button" data-dismiss="modal" class="btn orange" onclick="eliminar('{{$item->id}}');" >Eliminar</button>
    </div>
</div>
