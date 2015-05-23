{{ Form::open(['class'=>'form validate']) }}

{{ Form::hidden('total', $total) }}

<table class="table">
    <thead>
    <tr>
        <th></th>
        <th>Denominación</th>
        <th>Cantidad</th>
        <th>Suma</th>
    </tr>
    </thead>
    <tbody>
    @foreach(trans('lists.denominations') as $key => $value)
        <tr>
            <td>$</td>
            <td>{{ $value }}</td>
            <td class="text-center">
                {{ Form::text('quantity_'.$key, ($key == 1000) ? '' : 0, [($key == 1000) ? 'autofocus' : '', 'class'=>'text-right sm-input', 'data-required'=>'required', 'data-numeric'=>'numeric']) }}
            </td>
            <td class="text-right">0.00</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3"></td>
        <td class="text-right">$ 0.00</td>
    </tr>
    </tfoot>
</table>

<div class="text-center">
    <button type="submit" class="btn-blue">
        <i class="fa fa-calculator"></i>
        Calcular efectivo
    </button>
</div>

{{ Form::close() }}