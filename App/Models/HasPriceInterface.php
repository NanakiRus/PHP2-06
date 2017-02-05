<?php

namespace App\Models;

interface HasPriceInterface
{
    public function getPrice(): float;
}