@if(p(10))
    <a class="btn-red btn-delete" title="Eliminar del sistema" href="#" data-id="{{ $bank->id }}" data-name="{{ $bank->name }}">
        <i class="fa fa-times"></i>
    </a>
@endif