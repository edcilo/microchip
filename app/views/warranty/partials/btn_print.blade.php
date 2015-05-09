@if($warranty->status == 'Enviado')

    <a href="{{ route('warranty.print', $warranty->id) }}" target="_blank" class="btn-blue" title="Imprimir reporte de envío a garantía">
        <i class="fa fa-print"></i>
    </a>

@endif