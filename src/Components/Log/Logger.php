<?php

namespace Soosyze\Components\Log;

class Logger extends \Psr\Log\AbstractLogger
{
    protected $date_format = 'Y-m-d H:i:s';

    protected $message_format = '{date_format} {level} {message}';

    public function log($level, $message, array $context = [])
    {
        $context    = array_merge(
            [
            '{date_format}' => date($this->date_format, time()),
            '{message}'
            ],
            $context
        );
        $keyContext = array_keys($context);
        str_replace($keyContext, $context, $this->message_format);
    }

//    public function parse($level, $message, )
//    {
//        return str_replace($argsKey, $args, $this->message_format);
//    }

    public function setDateFormat($dateFormat)
    {
        $this->date_format = $dateFormat;

        return $this;
    }

    public function setMessageFormat($messageFormat)
    {
        $this->date_format = $messageFormat;

        return $this;
    }
}
