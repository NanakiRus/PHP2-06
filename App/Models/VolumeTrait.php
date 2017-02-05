<?php

namespace App\Models;

trait VolumeTrait
{
    protected $x;
    protected $y;
    protected $z;

    public function getVolume(): float
    {
        return $this->x * $this->y * $this->z;
    }
}