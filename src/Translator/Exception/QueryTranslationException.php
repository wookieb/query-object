<?php

namespace QueryObject\Translator\Exception;


class QueryTranslationException extends \Exception
{
    public function __construct($message, \Exception $cause = null)
    {
        parent::__construct($message, 0, $cause);
    }
}