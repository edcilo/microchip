<table class="table">
    <thead>
    <tr>
        <th>Movimiento</th>
        <th>Monto</th>
        <th>Fecha</th>
        <th>Descripción</th>
        <th>
            <i class="fa fa-gears"></i>
            Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($counts as $count)
        <tr>
            <td>{{ $count->status }}</td>
            <td class="text-right">$ {{ $count->amount }}</td>
            <td class="text-center">{{ $count->date_f }}</td>
            <td>{{ $count->description }}</td>
            <td class="text-center">
                @include('bankCount.partials.btn_edit')

                @include('bankCount.partials.btn_destroy')
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $counts->links() }}

@include('bankCount.partials.form_destroy')
