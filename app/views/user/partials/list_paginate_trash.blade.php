<table class="table">
    <thead>
    <tr>
        <th><i class="fa fa-camera"></i></th>
        <th>Nombre de usuario</th>
        <th>Nombre completo</th>
        <th>Departamento</th>
        <th>
            <i class="fa fa gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ( $users as $user )
        <tr>
            <td>
                <img src="{{ asset($user->profile->photo) }}" alt="{{ $user->username }}"/>
            </td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->profile->name }} {{ $user->profile->f_last_name }} {{ $user->profile->s_last_name }}</td>
            <td>{{ $user->department->name }}</td>
            <td class="text-center">
                <nobr>
                    @include('user.partials.btn_show')

                    @include('user.partials.btn_active')

                    @include('user.partials.btn_destroy')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $users->links() }}
