@if( p(34) )

    <div class="block description-product">

        <div class="header">
            Permisos
        </div>

        @if( count($permissions) )
            {{ Form::open(['route'=>['permission.user.update', $user->id], 'method'=>'post', 'class'=>'form validate']) }}

            <div class="row text-center">
                <button class="btn-green" type="submit">
                    Asignar permisos
                </button>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>
                            {{ Form::checkbox('permission_id[]', $permission->id, null, ['id'=>'permission_id_' . $permission->id]) }}
                        </td>
                        <td>
                            <label for="{{ 'permission_id_' . $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </td>
                        <td>
                            <label for="{{ 'permission_id_' . $permission->id }}">
                                {{ $permission->description }}
                            </label>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row text-center">
                <button class="btn-green" type="submit">
                    Asignar permisos
                </button>
            </div>

            {{ Form::close() }}
        @else

            <p class="title-clear">El usuario {{ $user->profile->full_name }} posee todos los permisos.</p>

        @endif

    </div>

@endif
