<div class="block description-product">

    <div class="subtitle">
        Usuarios
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>
                <i class="fa fa-camera"></i>
            </th>
            <th>Nombre</th>
            <th>Departamento</th>
            <th>
                <i class="fa fa-gears"></i>
                Opciones
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($permission->users as $user)
            <tr>
                <td class="text-center">
                    <img src="{{ asset($user->profile->photo) }}" alt="{{ $user->username }}"/>
                </td>
                <td>{{ $user->profile->full_name }}</td>
                <td>{{ $user->department->name }}</td>
                <td class="text-center">
                    @include('user.partials.btn_show')
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
