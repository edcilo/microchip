<table class="table">
    <thead>
    <tr>
        <th>Folio</th>
        <th>Estado</th>
        <th>Cliente</th>
        <th>Fecha/hora de entrada</th>
        <th>Fecha/hora de entrega</th>
        <th>Días en soporte</th>
        <th>Tiempo para entrega</th>
        <th>
            <i class="fa fa-gears"></i>
            Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($services as $service)
        <tr class="{{ $service->class_row }}">
            <td>{{ $service->folio }}</td>
            <td>{{ $service->data->status }}</td>
            <td>
                <a href="{{ route('customer.show', [$service->customer->slug, $service->customer->id]) }}">
                    {{ $service->customer->name }}
                </a>
            </td>
            <td class="text-center">{{ $service->created_at->format('h:m:i a, d-m-Y') }}</td>
            <td class="text-center">{{ $service->delivery_time }}, {{ $service->delivery_date }}</td>
            <td class="text-right">{{ $service->days_in_support }}</td>
            <td class="text-right">{{ $service->days_overdue }}</td>
            <td class="text-center">
                <nobr>
                    @include('service.partials.btn_show')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>