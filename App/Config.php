<?php

namespace App;


class Config
{
    public $data;
    private static $instance = null;

    protected function __construct()
    {
        $this->data = include __DIR__ . '/../config.php';
    }

    protected function __clone()
    {

    }

    protected function __wakeup()
    {

    }

    static public function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}