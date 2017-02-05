<?php

namespace App\Exception;


class ExceptionLog
    extends \Exception
{

    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->getLog();
    }

    private function getLog()
    {
        $log['message'] = 'Сообщение: ' . $this->getMessage();
        $log['code'] = 'Код: ' . $this->getCode();
        $log['file'] = 'В фалйе: ' . $this->getFile();
        $log['line'] = 'На строке: ' . $this->getLine();
        $log['trace'] = $this->getTraceAsString();

        $strLog = implode("\r\n", $log) . "\r\n" . '__________' . "\r\n";
        file_put_contents(__DIR__ . '/../../exceptionLog.txt', $strLog, FILE_APPEND);
    }

}