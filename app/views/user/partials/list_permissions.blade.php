@if( p(33) )

    <div class="block description-product edc-hide-show">

        <div class="subtitle">
            Permisos
            <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
        </div>

        <div class="edc-hide-show-element" style="display: none">

            <div class="col col100 text-right">

                @include('user.partials.btn_permissions')

            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

    @endif