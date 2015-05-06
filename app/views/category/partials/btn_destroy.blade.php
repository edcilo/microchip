@if( p(48) AND !count($category->products) )

    <a class="btn-red btn-delete" href="#" data-id="{{ $category->id }}" data-name="{{ $category->name }}">
        <i class="fa fa-times"></i>
    </a>

    @endif
