<div id="header">
    <table>
        <tr>
            <td>
                <img src="{{ asset($company->photo) }}" alt="Logotipo"/>
            </td>
            <td>
                <ul class="unlist">
                    <li>{{ $company->web }}</li>
                    <li><strong>Correo:</strong> {{ $company->email }}</li>
                    <li><strong>Tels.</strong>{{ $company->phone_1 }} y {{ $company->phone_2 }}, {{ $company->phone_3 }}</li>
                    <li>{{ $company->address }}, {{ $company->colony }}; {{ $company->city }}, {{ $company->state }}</li>
                </ul>
            </td>
            <td>
                <strong>Servicios:</strong> <br/>
                <ul class="unlist">
                    <li>{{ $company->services }}</li>
                </ul>
            </td>
        </tr>
    </table>
</div>