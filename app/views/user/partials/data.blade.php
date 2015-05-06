<div class="col col100">
    <figure class="flo col20 left">
        <img src="{{ asset($user->profile->photo) }}" alt="{{ $user->username }}"/>
    </figure>
    <div class="flo col40 center">
        <ul class="list-description">
            <li>
                <strong>Nombre de usuario: </strong>
                {{ $user->username }}
            </li>
            <li>
                <strong>Departamento: </strong>
                {{ $user->department->name }}
            </li>
            <li class="text-right">
                @include('user.partials.btn_edit_user')
            </li>
        </ul>
        <hr/>
        <ul class="list-description">
            <li>
                <strong>Nombre:</strong>
                {{ $user->profile->name }} {{ $user->profile->f_last_name }} {{ $user->profile->s_last_name }}
            </li>
            <li>
                <strong>Fecha de nacimiento:</strong>
                {{ $user->profile->birthday_f }}
            </li>
            <li>
                <strong>Sexo:</strong>
                {{ $user->profile->sex }}
            </li>
            <li>
                <strong>Estado civil</strong>
                {{ $user->profile->marital_status }}
            </li>
            @if ( $user->profile->marital_status == 'Casado' )
                <li>
                    <strong>Nombre de conyuge:</strong>
                    {{ $user->profile->wife }}
                </li>
            @endif
        </ul>
    </div>
    <div class="flo col40 right">
        <ul class="list-description">
            <li>
                <strong>Teléfono fijo:</strong>
                {{ $user->profile->phone }}
            </li>
            <li>
                <strong>Teléfono celular:</strong>
                {{ $user->profile->cellphone }}
            </li>
            <li>
                <strong>Correo electrónico:</strong>
                {{ $user->profile->email }}
            </li>
            <li>
                <strong>Dirección:</strong>
                <ul>
                    <li>{{ $user->profile->full_address }}</li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<hr/>

<div class="col col100">
    <div class="flo col50 center">
        <ul class="list-description">
            <li>
                <strong>Referencias:</strong>
                <ul>
                    <li>{{ $user->profile->reference_1 }} - {{ $user->profile->ref_phone_1 }}</li>
                    <li>{{ $user->profile->reference_2 }} - {{ $user->profile->ref_phone_2 }}</li>
                    <li>{{ $user->profile->reference_3 }} - {{ $user->profile->ref_phone_3 }}</li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="flo col50 right">
        <ul class="list-description">
            <li>
                <strong>Observaciones:</strong>
                {{ $user->profile->observations }}
            </li>
        </ul>
    </div>
</div>
