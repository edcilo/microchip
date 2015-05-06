@if ( p(44) AND !count($mark->products) )
    <a class="btn-red btn-delete" href="#" data-id="{{ $mark->id }}" data-name="{{ $mark->name }}">
        <i class="fa fa-times"></i>
    </a>
@endif
