<div class="col col100 block description-product edc-hide-show">

    <div class="subtitle">
        <strong>Pendientes en caja</strong>
        <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
    </div>

    <div class="edc-hide-show-element hide">

        <div class="subtitle_mark">
            Cambios pendientes
        </div>

        @if(count($pending))
        <table class="table">
            <thead>
            <tr>
                <th>Monto</th>
                <th>Concepto</th>
                <th>Empleado que recibio</th>
                <th>Empleado que autorizó</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pending as $pay)
                <tr>
                    <td class="text-right">$ {{ -1 * $pay->amount }}</td>
                    <td>@if($pay->concept) {{ $pay->concept->concept }}; @endif {{ $pay->description }}</td>
                    <td>{{ $pay->user->profile->full_name }}</td>
                    <td>{{ $pay->user_receiving->profile->full_name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <p>No hay cambios pendientes</p>
        @endif

        {{ $pending->links() }}


        <div class="subtitle_mark">
            Documentos pendientes en caja
        </div>

        @if(count($documents_pending))

            <table class="table">
                <thead>
                <tr>
                    <th>Folio</th>
                    <th>Documento</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Abono</th>
                    <th>Saldo</th>
                </tr>
                </thead>
                <tbody>
                @foreach($documents_pending as $sale)
                    <tr>
                        <td>{{ $sale->folio }}</td>
                        <td>{{ $sale->classification }}</td>
                        <td>{{ $sale->customer->name }}</td>
                        <td class="text-center">{{ $sale->created_at }}</td>
                        <td class="text-right">
                            <nobr>
                                $ {{ $sale->total_f }}
                                @if( $sale->new_price > 0 )
                                    + $ {{ $sale->difference_iva }}
                                    = $ {{ $sale->pv_di_f }}
                                @endif
                            </nobr>
                        </td>
                        <td class="text-right">
                            <nobr>$ {{ $sale->user_total_pay_f }}</nobr>
                        </td>
                        <td class="text-right">$ {{ $sale->user_rest_total_f }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $documents_pending->links() }}

        @else

            <p class="title-clear">No hay pagos pendientes</p>

        @endif

        <div class="subtitle_mark">
            Cancelaciones
        </div>

        @if(count($cancellations))

            <table class="table">
                <thead>
                <tr>
                    <th>Folio</th>
                    <th>Documento</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Saldo</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cancellations as $cancellation)
                    <tr>
                        <td>{{ $cancellation->folio }}</td>
                        <td>{{ $cancellation->classification }}</td>
                        <td>{{ $cancellation->customer->name }}</td>
                        <td class="text-center">{{ $cancellation->created_at }}</td>
                        @if ($cancellation->classification == 'Venta')
                            <td class="text-right">$ {{ $cancellation->total_f }}</td>
                        @else
                            <td class="text-right">$ {{ $cancellation->total_order_f }}</td>
                        @endif
                        <td class="text-right">$ {{ $cancellation->user_total_pay_f }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else

            <p class="title-clear">No hay cancelaciones pendientes</p>

        @endif


    </div>
</div>