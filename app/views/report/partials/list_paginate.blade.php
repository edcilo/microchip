<table class="table">
    <thead>
    <tr>
        <th>No.</th>
        <th>Fecha de inicio</th>
        <th>Fecha limite</th>
        <th>
            <i class="fa fa-gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($reports as $report)
        <tr>
            <td class="text-right">{{ $report->id }}</td>
            <td class="text-center">{{ $report->date_init }}</td>
            <td class="text-center">{{ $report->date_end }}</td>
            <td class="text-center">
                <nobr>
                    @include('report.partials.btn_show')

                    @include('report.partials.btn_edit')

                    @include('report.partials.btn_destroy')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $reports->links() }}
