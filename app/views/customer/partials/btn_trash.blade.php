@if( p(66) AND $customer->active AND $customer->id != 1 )

    <a class="btn-red btn-recycle" title="Enviar a la papelera" href="#" data-id="{{ $customer->id }}" data-name="{{ $customer->name }}">
        <i class="fa fa-trash"></i>
    </a>

    @endif