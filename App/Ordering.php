<?php

namespace App;

use App\Models\CanOrderInterface;

class Ordering
{
    public function order(CanOrderInterface $item)
    {
        echo 'Заказ товара';
        echo 'Цена: ' . $item->getPrice();
    }
}