@if( p(22) )

    <a class="btn-yellow" href="{{ route('department.edit', [$department->slug, $department->id]) }}">
        <i class="fa fa-pencil"></i>
    </a>

@endif
