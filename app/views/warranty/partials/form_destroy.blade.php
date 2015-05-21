@if(p(121))
    {{ Form::open(['route' => ['warranty.destroy', $warranty->id], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}

    <button type="submit" class="btn-red" title="Eliminar garantía">
        <i class="fa fa-times"></i>
        Eliminar garantía {{ $warranty->folio }}
    </button>

    {{ Form::close() }}
@endif