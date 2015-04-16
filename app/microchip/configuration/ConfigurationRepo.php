<?php namespace microchip\configuration;

use microchip\base\BaseRepo;

class ConfigurationRepo extends BaseRepo {

    public function getModel()
    {
        return new Configuration();
    }

    public function Configuration()
    {
        return $configuration = new Configuration();
    }

}