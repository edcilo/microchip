@if( p(13) )
    <a href="{{ route('cheque.edit', [$cheque->folio, $cheque->id]) }}" class="btn-yellow">
        <i class="fa fa-pencil"></i>
    </a>
@endif