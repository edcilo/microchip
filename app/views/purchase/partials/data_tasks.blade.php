<div class="col col100 block description-product">

    <div class="subtitle">
        Tareas
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>Terminar alta de productos</th>
            <th>Terminar alta de N/S</th>
            <th>Registrar metodo de pago</th>
            <th>Subir factura escaneada</th>
        </tr>
        </thead>
        <tbody>
        <tr class="text-center">
            <td>
                @if ( !$purchase->progress_4 )
                    <i class="fa fa-check"></i>
                @else
                    <i class="fa fa-times"></i>
                @endif
            </td>
            <td>
                @if ( $purchase->progress_3 )
                    <i class="fa fa-check"></i>
                @else
                    <i class="fa fa-times"></i>
                @endif
            </td>
            <td>
                @if ( $purchase->progress_1 )
                    <i class="fa fa-check"></i>
                @else
                    <i class="fa fa-times"></i>
                @endif
            </td>
            <td>
                @if ( $purchase->progress_2 )
                    <i class="fa fa-check"></i>
                @else
                    <i class="fa fa-times"></i>
                @endif
            </td>
        </tr>
        </tbody>
    </table>
</div>
