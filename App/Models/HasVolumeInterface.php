<?php
/**
 * Created by PhpStorm.
 * User: Phil
 * Date: 12.01.2017
 * Time: 21:13
 */

namespace App\Models;


interface HasVolumeInterface
{

    public function getVolume(): float;

}