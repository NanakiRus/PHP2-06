<?php

namespace App\Models;

use App\Model;

/**
 * Class Author
 * @package App\Models
 * @property string $firstname
 * @property string $lastname
 */
class Author
    extends Model
{

    public static $table = 'author';

    public $firstname;
    public $lastname;

}