<?php

require __DIR__ . '/autoload.php';

$parts = explode('/', $_SERVER['REQUEST_URI']);

$controllerName = $_GET['ctrl'] ?? 'Index';

$controllerClassName = '\\App\\Controller\\' . $controllerName;

$actionName = $_GET['act'] ?? 'All';

try {

    if (true === class_exists($controllerClassName)) {
        $controller = new $controllerClassName;
    } else {
        throw new \App\Exception\Exception404('Страница не найдена', 404);
    }

    $controller->action($actionName);

} catch (\App\Exception\Exception404 $error) {

    $log = new \App\Log\PsrLogger(__DIR__ . '/exceptionLog.txt');
    $log->emergency($error->getMessage(), \App\Log\PsrLogger::getArrErr($error));

    header("HTTP/1.0 404 Not Found");
    die;

} catch (\App\Exception\ExceptionDB $error) {

    $log = new \App\Log\PsrLogger(__DIR__ . '/exceptionLog.txt');
    $log->emergency($error->getMessage(), \App\Log\PsrLogger::getArrErr($error));

    $view = new \App\View();
    $view->error = $error;
    $view->view(__DIR__ . '/template/error.php');

}
