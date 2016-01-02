<?php

namespace QueryObject\Translator\Event;

use QueryObject\Condition\ConditionInterface;
use QueryObject\Query;
use QueryObject\Translator\TranslationContext;
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
     * @var ConditionInterface
     */
    private $condition;
    /**
     * @var TranslationContext
     */
    private $context;

    public function __construct(TranslationContext $context, Query $query, ConditionInterface $condition = null)
    {
        $this->context = $context;
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

    /**
     * @return TranslationContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Marks event as handled and thus stops further propagation
     */
    public function markAsHandled()
    {
        $this->stopPropagation();
    }

    public function isHandled()
    {
        return $this->isPropagationStopped();
    }
}