@if( count($sale->payments) > 0 )
    <table class="table">
        <thead>
        <tr>
            <th>Monto</th>
            <th>Método</th>
            <th>No. de tarjeta/No. de cheque/Folio/Referencia</th>
            <th>Banco/IFE</th>
            <th>Descripción</th>
            <th>Empleado en caja</th>
            <th>Empleado que recibio</th>
            <th>Fecha de pago</th>
            @if ($sale->status != 'Cancelado')
                <th>
                    <i class="fa fa-gears"></i>
                </th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($sale->payments as $pay)
            <tr>
                <td class="text-right">
                    <nobr>$ {{ $pay->amount - $pay->change }}</nobr>
                </td>
                <td>{{ $pay->method }}</td>
                <td>
                    @if($pay->method == 'Vale')
                        <a href="{{ route('coupon.show', [$pay->coupon->folio, $pay->coupon->id]) }}">
                            {{ $pay->coupon->folio }}
                        </a>
                    @else
                        {{ $pay->reference }}
                    @endif
                </td>
                <td>{{ $pay->entity }}</td>
                <td>{{ $pay->description }}</td>
                <td>
                    <a href="{{ route('user.show', [$pay->user->slug, $pay->user->id]) }}">
                        {{ $pay->user->username }}
                    </a>
                </td>
                <td>
                    @if( is_object($pay->user_receiving) )
                        <a href="{{ route('user.show', [$pay->user_receiving->slug, $pay->user_receiving->id]) }}">
                            {{ $pay->user_receiving->username }}
                        </a>
                    @endif
                </td>
                <td class="text-center">{{ $pay->date }}</td>
                <td class="text-center">
                    <nobr>
                        @include('pay.partials.btn_print')

                        @if ($sale->status != 'Cancelado')
                            @include('pay.partials.btn_edit')

                            @include('pay.partials.btn_destroy')
                        @endif
                    </nobr>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else

    <p class="title-clear">Aún no se registrán ningún cargo o abono</p>

@endif
