<?php

namespace QueryObject\Translator;


use QueryObject\Condition\ConditionInterface;

class TranslationContext
{
    private $handledConditions = [];

    public function markConditionAsHandled(ConditionInterface $condition)
    {
        $this->handledConditions[] = $condition;
    }

    public function isConditionHandled(ConditionInterface $condition)
    {
        return array_search($condition, $this->handledConditions, true) !== false;
    }
}