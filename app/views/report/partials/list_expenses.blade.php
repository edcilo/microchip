<div class="col col100 block description-product edc-hide-show">

    <div class="subtitle">
        Gastos
        <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
    </div>

    <div class="table edc-hide-show-element hide">

        <table class="table">
            <thead>
            <tr>
                <th>Concepto</th>
                <th>Empleado que recibio</th>
                <th>Empleado que autorizó</th>
                <th>Pendiente</th>
                <th>Monto</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pays as $pay)
                @if($pay->amount < 0)
                    <tr class="@if($pay->change_check) red @endif">
                        <td>
                            {{ $pay->description }}
                        </td>
                        <td>
                            {{ $pay->user->profile->name }}
                        </td>
                        <td>
                            {{ $pay->userReceiving->profile->name }}
                        </td>
                        <td class="text-center">
                            @if($pay->change_check)
                                <i class="fa fa-check"></i>
                            @else
                                <i class="fa fa-times"></i>
                            @endif
                        </td>
                        <td class="text-right">
                            ${{ number_format($pay->amount - $pay->change, 2, '.', ',') }}
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>

    </div>

</div>