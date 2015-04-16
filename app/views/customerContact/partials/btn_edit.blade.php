@if( p(65) )

    <a href="{{ route('customer.edit', [$contact->dataContact->slug, $contact->dataContact->id]) }}" class="btn-yellow" title="Modificar datos de {{ $contact->dataContact->name }}">
        <i class="fa fa-pencil"></i>
    </a>

    @endif