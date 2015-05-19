<div class="col col100 block description-product edc-hide-show">

    <div class="subtitle">
        Notas de crédito:
        <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
    </div>

    <div class="edc-hide-show-element col col100">

        <table class="table">
            <thead>
            <tr>
                <th>Disponibilidad</th>
                <th>Folio</th>
                <th>Costo de compra</th>
                <th>Costo de venta</th>
                <th>
                    <i class="fa fa-gears"></i> Opciones
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($sale->data->warranty->warranties as $warranty)
                @if($warranty->coupon)
                    <tr>
                        <td>
                            @if($warranty->coupon->available)
                                <i class="fa fa-check"></i>
                            @else
                                <i class="fa fa-times"></i>
                            @endif
                        </td>
                        <td>{{ $warranty->coupon->folio }}</td>
                        <td class="text-right">$ {{ $warranty->coupon->value }}</td>
                        <td class="text-right">$ {{ $warranty->series->movementOut->selling_price }}</td>
                        <td class="text-center">

                            @if($warranty->couponCustomer)

                                Vale creado:
                                <a href="{{ route('coupon.show', [$warranty->couponCustomer->folio, $warranty->couponCustomer->id]) }}">
                                    {{ $warranty->couponCustomer->folio }}
                                </a>

                            @else
                                {{ Form::open(['route'=>['coupon.store', $warranty->sale->id], 'class'=>'form validate']) }}

                                {{ Form::hidden('warranty_id', $warranty->id) }}

                                $ {{ Form::text('value', $warranty->series->movementOut->selling_price, ['placeholder' => 'Valor', 'class'=>'sm-input text-right', 'title'=>'Valor de vale o monto a depositar en el monedero', 'data-required'=>'required', 'data-numeric'=>'numeric']) }}

                                {{ Form::radio('type', 'coupon', 1, ['id' => 'type_coupon']) }}
                                {{ Form::label('type_coupon', 'Vale') }}

                                {{ Form::radio('type', 'card', null, ['id' => 'type_card']) }}
                                {{ Form::label('type_card', 'Monedero') }}

                                <button type="submit" class="btn-green">
                                    <i class="fa fa-save"></i>
                                    Guardar
                                </button>

                                <div class="message-error">
                                    {{ $errors->first('value', '<span>:message</span>') }}
                                    {{ $errors->first('type', '<span>:message</span>') }}
                                </div>

                                {{ Form::close() }}
                            @endif

                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>

    </div>

</div>
