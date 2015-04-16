<table class="table">
    <thead>
    <tr>
        <th><i class="fa fa-camera"></i></th>
        <th>Nombre de usuario</th>
        <th>Nombre completo</th>
        <th>Departamento</th>
        <th>Salario</th>
        <th>Comisión</th>
        <th>Total</th>
        <th>
            <i class="fa fa gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ( $results as $profile )
        <?php $user = $profile->user ?>
        <tr @if(!$user->active)class="red"@endif >
            <td>
                <img src="{{ asset($profile->photo) }}" alt="{{ $profile->user->username }}"/>
            </td>
            <td>{{ $profile->user->username }}</td>
            <td>{{ $profile->name }} {{ $profile->f_last_name }} {{ $profile->s_last_name }}</td>
            <td>{{ $profile->user->department->name }}</td>
            <td class="text-right">$ {{ $profile->salary_f }}</td>
            <td class="text-right">$ {{ $profile->user->commission_t_f }}</td>
            <td class="text-right">$ {{ $profile->user->salary_t_f }}</td>
            <td>
                <nobr>
                    @include('user.partials.btn_pay')

                    @include('user.partials.btn_show')

                    @include('user.partials.btn_edit')

                    @include('user.partials.btn_trash')

                    @include('user.partials.btn_active')

                    @include('user.partials.btn_delete')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $results->appends(['terms' => $terms])->links() }}