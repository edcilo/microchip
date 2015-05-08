{{ Form::open(['route' => ['warranty.destroy', $warranty->id], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}

<button type="submit" class="btn-red">
    <i class="fa fa-times"></i>
    Eliminar garantía {{ $warranty->folio }}
</button>

{{ Form::close() }}