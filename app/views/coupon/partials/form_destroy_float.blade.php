@if( p(116) )

    <div class="confirm-dialog hide" title="Eliminar vale" id="dialogConfirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer eliminar el vale <span class="data_name"></span>?</h3>
        </div>
    </div>
    {{ Form::open(['route' => ['coupon.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

@endif
