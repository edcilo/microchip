@if(p(4))
    <a href="{{ route('company.edit', [1]) }}" class="btn-yellow">
        <i class="fa fa-pencil"></i>
        Editar datos de {{ $company->name }}
    </a>
@endif