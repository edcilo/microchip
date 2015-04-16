<?php namespace microchip\provider;

class ProviderFormat {

    public function formatData(&$provider)
    {
        $provider->number = ($provider->number == 0) ? '' : $provider->number;
        $provider->postcode = ($provider->postcode == 0) ? '' : $provider->postcode;
    }

}