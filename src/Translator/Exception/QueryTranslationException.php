<?php

namespace QueryObject\Translator\Exception;


use QueryObject\Query;

class QueryTranslationException extends \Exception
{
    public function __construct(Query $query, $message, \Exception $cause = null)
    {
        parent::__construct($message, 0, $cause);
    }
}