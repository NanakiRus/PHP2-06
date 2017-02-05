<?php

namespace App\Models;

class Vegetable
    implements HasPriceInterface
{

    public function getPrice(): float
    {
        return 13;
    }
}