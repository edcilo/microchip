@include('layouts.partials.style_print')

<ul class="unlist">
    <li>
        <strong>Servicio no.:</strong>
        {{ $comment->sale->folio }}
    </li>
</ul>

<ul class="unlist">
    <li>
        <strong>Con atención a:</strong>
        {{ $comment->sale->customer->prefix }}
        {{ $comment->sale->customer->name }}
    </li>
    <li>
        <strong>Telefono(s):</strong>
        {{ $comment->sale->customer->phone }} - {{ $comment->sale->customer->cellphone }}
    </li>
    <li>
        <strong>E-mail:</strong>
        {{ $comment->sale->customer->email }}
    </li>
</ul>

<strong>Anexo:</strong>
<br/>
{{ $comment->comment }}
