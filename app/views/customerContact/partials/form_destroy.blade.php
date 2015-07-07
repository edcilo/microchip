@if( p(65) )

    {{ Form::open(['route'=>['customer.contact.destroy',  $contact->id], 'method'=>'delete', 'class'=>'inline']) }}
        <button type="submit" class="btn-red form_confirm" data-confirm="destroy_contact_confirm">
            <i class="fa fa-times"></i>
        </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Eliminar contacto" id="destroy_contact_confirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer eliminar al contacto <strong>{{ $contact->dataContact->name }}</strong>?</p>
        </div>
    </div>

@endif
