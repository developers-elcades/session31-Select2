<table class="table table-bordered">
    <thead>
    <th>Nombre</th>
    <th>Acción</th>
    </thead>
    <tbody>
    @foreach($marks as $mark)
        <tr>
            <td>{{$mark->name}}</td>
            <td>
                <a href="{{route('mark.edit',$mark->id)}}">[Editar]</a>
                <a href="{{route('mark.show',$mark->id)}}">[Eliminar]</a></td>
        </tr>
    @endforeach
    </tbody>


</table>
<div class="text-center">
    {!!$marks->links()!!}
</div>