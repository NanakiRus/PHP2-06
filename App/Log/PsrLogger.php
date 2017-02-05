<?php

namespace App\Log;


use Psr\Log\AbstractLogger;

class PsrLogger
    extends AbstractLogger
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function addRecord($level, $message, $context)
    {
        if (file_exists($this->path) && is_writable($this->path)) {
            $context = ['level' => 'Уровень ошибки: ' . $level, 'message' => 'Сообщение: ' . $message,] + $context;
            $strContext = implode("\r\n", $context) . "\r\n" . '__________' . "\r\n";
            file_put_contents($this->path, $strContext, FILE_APPEND);
        }
    }

    public static function getArrErr(\Exception $err)
    {
        $context['code'] = 'Код: ' . $err->getCode();
        $context['line'] = 'Строка: ' . $err->getLine();
        $context['file'] = 'В файле: ' . $err->getFile();
        $context['trace'] = 'Trace: ' . $err->getTraceAsString();

        return $context;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        if (is_string($level) && defined(__CLASS__ . '::' . strtoupper($level))) {
            $level = constant(__CLASS__ . '::' . strtoupper($level));
        }

        $this->addRecord($level, $message, $context);
    }
}