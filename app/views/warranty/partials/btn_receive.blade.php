@if ($warranty->status == 'Enviado')

    <a href="{{ route('warranty.resolutor', $warranty->id)}}" class="btn-green" title="Resolver garantía">
        <i class="fa fa-arrow-left"></i>
    </a>

@endif