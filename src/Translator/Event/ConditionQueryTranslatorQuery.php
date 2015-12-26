<?php

namespace QueryObject\Translator\Event;


use QueryObject\Condition\ConditionInterface;
use QueryObject\Query;

class ConditionQueryTranslatorQuery extends QueryTranslatorEvent
{
    const TRANSLATE_CONDITION = 'translate:condition';

    /**
     * @var ConditionInterface
     */
    private $condition;

    public function __construct(Query $query, ConditionInterface $condition)
    {
        parent::__construct($query);

        $this->condition = $condition;
    }

    /**
     * @return ConditionInterface
     */
    public function getCondition()
    {
        return $this->condition;
    }
}