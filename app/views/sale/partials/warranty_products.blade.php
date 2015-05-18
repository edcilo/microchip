@if( count($sale->warranties))
    <div class="col col100 block description-product edc-hide-show">

        <div class="subtitle">
            Productos cambiados por garantía:
            <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
        </div>

        <div class="edc-hide-show-element col col100">

            <table class="table">
                <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th>S/N</th>
                    <th>Descripción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sale->movements as $movement)
                    @if($movement->q_warranty)
                        <tr>
                            <td class="text-right">{{ $movement->quantity }}</td>
                            <td>{{ $movement->product->barcode}}</td>
                            <td>{{ $movement->seriesOut[0]->ns }}</td>
                            <td>{{ $movement->product->s_description }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>


        </div>

    </div>
@endif
