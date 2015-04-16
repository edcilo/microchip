<table class="table">
    <thead>
    <tr>
        <th>
            <i class="fa fa-camera"></i>
        </th>
        <th>Nombre de usuario</th>
        <th>Nombre completo</th>
        <th>Fecha de contratación</th>
        <th>Salario</th>
    </tr>
    </thead>
    <tbody>
    @foreach($department->users as $user)
        <tr>
            <td class="text-center">
                <img src="{{ asset($user->profile->photo) }}" alt="{{ $user->username }}"/>
            </td>
            <td>
                <a href="{{ route('user.show', [$user->slug, $user->id]) }}">
                    {{ $user->username }}
                </a>
            </td>
            <td>{{ $user->profile->name }} {{ $user->profile->f_last_name }} {{ $user->profile->s_last_name }}</td>
            <td class="text-center">{{ $user->profile->hired_f }}</td>
            <td class="text-right">${{ $user->profile->salary_f }}</td>
        </tr>
    @endforeach
    </tbody>
</table>