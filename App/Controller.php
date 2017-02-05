<?php

namespace App;

use App\Exception\Exception404;

abstract class Controller
{

    protected $view;

    public function __construct()
    {
        $this->view = new \App\View();
    }

    protected function beforeAction()
    {
    }

    protected function access(): bool
    {
        return true;
    }

    public function action($name)
    {
        $this->beforeAction();
        $action = 'action' . $name;
        if (true === method_exists(static::class, $action)) {
            if (true === $this->access()) {
                $this->$action();
            } else {
                die('Доступ закрыт');
            }
        } else {
            throw new Exception404('Ошибка', 404);
        }
    }
}