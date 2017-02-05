<?php

require __DIR__ . '/autoload.php';

$logger = new \App\Exception\ExceptionPsrLogger();

$logger->routes->attach(new \App\Exception\ExceptionPsrLoggerFileRoute([
    'isEnable' => true,
    'path' => 'exceptionLog.txt',
]));


$logger->info("Info message");
$logger->alert("Alert message");
$logger->error("Error message");
$logger->debug("Debug message");
$logger->notice("Notice message");
$logger->warning("Warning message");
$logger->critical("Critical message");
$logger->emergency("Emergency message");