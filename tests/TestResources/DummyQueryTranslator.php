<?php

namespace QueryObject\Tests\TestResources;


use QueryObject\Query;
use QueryObject\Translator\AbstractQueryTranslator;
use QueryObject\Translator\TranslationContext;

class DummyQueryTranslator extends AbstractQueryTranslator
{
    /**
     * @var TranslationContext
     */
    public $context;

    public function translate(Query $query)
    {
        $this->runTranslation($query);
    }

    protected function createContext()
    {
        return $this->context = parent::createContext();
    }
}