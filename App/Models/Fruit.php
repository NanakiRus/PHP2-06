<?php

namespace App\Models;

class Fruit
    implements CanOrderInterface, HasVolumeInterface
{

    use VolumeTrait;

    public function getPrice(): float
    {
        return 42;
    }

    public function getWeight(): float
    {
        return 0.100;
    }
}