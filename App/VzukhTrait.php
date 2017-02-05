<?php

namespace App;

/**
 * Class VzukhTrait
 * @package App
 */
trait VzukhTrait
{
    protected $data = [];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __isset($name)
    {
        return $this->data[$name];
    }
}