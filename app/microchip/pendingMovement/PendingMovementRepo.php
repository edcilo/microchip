<?php namespace microchip\pendingMovement;

use microchip\base\BaseRepo;

class PendingMovementRepo extends BaseRepo {

    public function getModel()
    {
        return new PendingMovement();
    }

    public function newPA()
    {
        return $pa = new PendingMovement();
    }

}