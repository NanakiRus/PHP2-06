<?php

namespace App\Exception;

class ExceptionMulti
    extends \Exception
    implements \Iterator
{
    protected $data = [];

    public function addError($data)
    {
        $this->data[] = $data;
    }

    public function errors()
    {
        if (!empty($this->data)) {
            return true;
        } else {
            return false;
        }
    }


    public function current()
    {
        return current($this->data);
    }


    public function next()
    {
        next($this->data);
    }


    public function key()
    {
        return key($this->data);
    }


    public function valid()
    {
        return null !== key($this->data);
    }


    public function rewind()
    {
        reset($this->data);
    }
}