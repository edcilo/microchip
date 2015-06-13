@if($services->getTotal())
    <div class="col col100 block description-product edc-hide-show">

        <div class="subtitle">
            {{ $services->getTotal() }} Servicio(s)
            <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
        </div>

        <div class="table edc-hide-show-element hide">

            <table class="table">
                <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Documento</th>
                    <th>Folio</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>
                        <i class="fa fa-gears"></i>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->type }}</td>
                        <td>{{ $service->classification }}</td>
                        <td>{{ $service->folio }}</td>
                        <td>{{ $service->status }}</td>
                        <td class="text-center">{{ $service->created_at->format('h:m a / d-m-Y') }}</td>
                        <td class="text-center">
                            @include('service.partials.btn_show')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $services->links(); }}

        </div>

    </div>
@endif