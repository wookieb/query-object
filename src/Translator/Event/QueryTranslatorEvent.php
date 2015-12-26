<?php

namespace QueryObject\Translator\Event;

use QueryObject\Condition\ConditionInterface;
use QueryObject\Query;
use Symfony\Component\EventDispatcher\Event;

class QueryTranslatorEvent extends Event
{
    const TRANSLATE_QUERY = 'translate:query';
    const TRANSLATE_CONDITION = 'translate:condition';

    /**
     * @var Query
     */
    private $query;

    /**
     * @var bool
     */
    private $handled = false;
    /**
     * @var ConditionInterface
     */
    private $condition;

    public function __construct(Query $query, ConditionInterface $condition = false)
    {
        $this->query = $query;
        $this->condition = $condition;
    }

    /**
     * @return Query
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return ConditionInterface
     */
    public function getCondition()
    {
        return $this->condition;
    }

    public function markAsHandled()
    {
        $this->handled = true;
    }

    public function isHandled()
    {
        return $this->handled;
    }
}