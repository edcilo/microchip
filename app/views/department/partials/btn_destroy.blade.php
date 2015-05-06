@if ( p(23) AND count($department->users) == 0 )
    <a class="btn-red btn-delete" href="#" data-id="{{ $department->id }}" data-name="{{ $department->name }}">
        <i class="fa fa-times"></i>
    </a>
@endif
