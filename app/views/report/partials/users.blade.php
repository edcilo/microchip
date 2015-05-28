<div class="col col100 block description-product edc-hide-show">

    <div class="subtitle">
        Reporte por empleado
        <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
    </div>

    <div class="table edc-hide-show-element">

        @foreach($users as $user)
            @if($user->pays->count())
                <div class="subtitle">
                    {{ $user->profile->full_name }}
                </div>

                <strong>Pagos en efectivo</strong>
                @include('report.partials.table_report', ['method'=>'Efectivo', 'total'=>0.00])

                <strong>Cobros con tarjeta de crédito/debito</strong>
                @include('report.partials.table_report', ['method'=>'Tarjeta de crédito/débito', 'total'=>0.00])

                <strong>Transferencias</strong>
                @include('report.partials.table_report', ['method'=>'Transferencia', 'total'=>0.00])

                <strong>Cheques</strong>
                @include('report.partials.table_report', ['method'=>'Cheque', 'total'=>0.00])

                <strong>Vales</strong>
                @include('report.partials.table_report', ['method'=>'Vale', 'total'=>0.00])

                <strong>Monedero electrónico</strong>
                @include('report.partials.table_report', ['method'=>'Monedero', 'total'=>0.00])
            @endif
        @endforeach

    </div>

</div>