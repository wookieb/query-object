<?php

namespace QueryObject\Tests\TestResources;


use QueryObject\Query;
use QueryObject\Translator\AbstractQueryTranslator;

class QueryTranslatorBridge extends AbstractQueryTranslator
{
    public function translate(Query $query)
    {
        $this->runTranslation($query);
    }
}