<table class="table">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Fecha de vencimiento</th>
        <th>Días de vigencia</th>
    </tr>
    </thead>
    <tbody>
    @foreach( $customer->referenced as $referenced )
        <tr>
            <td>
                <a href="{{ route('customer.show', [$referenced->referenced->slug, $referenced->referenced->id]) }}">
                    {{ $referenced->referenced->name }}
                </a>
            </td>
            <td class="text-center">{{ $referenced->expiration_date }}</td>
            <td class="text-center">
                @if ( $referenced->expiration_date == 'Vencido' OR $referenced->expiration_date == 'Indefinido' )

                    @include('customerReferrer.partials.form_edit')

                @else

                    {{ $referenced->expiration }} días.

                @endif

                @include('customerReferrer.partials.btn_destroy')
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@include('customerReferrer.partials.form_destroy_float')
