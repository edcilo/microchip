<?php

namespace microchip\providerContact;

use microchip\base\BaseManager;

class ProviderContactUpdManager extends BaseManager
{
    public function getRules()
    {
        return [
            'name'          => 'required|max:120',
            'last_name'     => 'max:120',
            'job'           => 'max:120',
            'phone'         => 'numeric',
            'email'         => 'email',
            'provider_id'   => 'required|exists:providers,id',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        return $data;
    }
}
