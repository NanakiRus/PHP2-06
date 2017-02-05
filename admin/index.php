<?php

require __DIR__ . '/../autoload.php';

$controllerName = $_GET['ctrl'] ?? 'Admin';

$controllerClassName = '\\App\\Controller\\' . $controllerName;

$actionName = $_GET['act'] ?? 'All';

try {

    if (true === class_exists($controllerClassName)) {
        $controller = new $controllerClassName;
    } else {
        throw new \App\Exception\Exception404('Страница не найдена', 404);
    }

    $controller->action($actionName);

} catch (\App\Exception\ExceptionMulti $errors) {
    $view = new \App\View();
    $view->errors = $errors;
    $view->view(__DIR__ . '/../template/admin/error.php');

} catch (\App\Exception\Exception404 $error) {

    header("HTTP/1.0 404 Not Found");
    die;

}
