@if($warranty->status != 'Terminado' AND p(121))

<a class="btn-red btn-delete" href="#" data-id="{{ $warranty->id }}" data-name="{{ $warranty->folio }}" title="Eliminar garantía">
    <i class="fa fa-times"></i>
</a>

@endif