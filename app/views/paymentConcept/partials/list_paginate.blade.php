<table class="table">
    <thead>
    <tr>
        <th>Concepto</th>
        <th>Gasto</th>
        <th>Relacionado con</th>
        <th>
            <i class="fa fa-gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($concepts as $concept)
        <tr>
            <td>{{ $concept->concept }}</td>
            <td class="text-center">
                @if ($concept->spending)
                    <i class="fa fa-check"></i>
                @else
                    <i class="fa fa-times"></i>
                @endif
            </td>
            <td>{{ $concept->document }}</td>
            <td class="text-center">
                <nobr>
                    @include('paymentConcept.partials.btn_edit')

                    @include('paymentConcept.partials.btn_destroy')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $concepts->links() }}
