@if( p(53) )

    <a class="btn-red btn-delete" href="#" data-id="{{ $movement->id }}" data-name="{{ $movement->created_at->format('h:i:s A / d-m-Y') }}">
        <i class="fa fa-times"></i>
    </a>

    @endif
