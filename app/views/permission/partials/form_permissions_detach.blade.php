@if( p(34) )

    <div class="block description-product">

        <div class="header">
            Permisos del empleado
        </div>

        @if( count($user->permissions) )
            {{ Form::open(['route'=>['permission.user.destroy', $user->id], 'method'=>'post', 'class'=>'form validate']) }}

            <div class="row text-center">
                <button class="btn-red" type="submit">
                    Denegar permisos
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
                @foreach($user->permissions as $permission)
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
                <button class="btn-red" type="submit">
                    Denegar permisos
                </button>
            </div>

            {{ Form::close() }}
        @else

            <p class="title-clear">El usuario {{ $user->profile->full_name }} no cuenta con ningún permiso.</p>

        @endif

    </div>

@endif
