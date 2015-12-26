<?php

namespace QueryObject\Translator;


use QueryObject\Condition\ConditionInterface;
use QueryObject\Query;
use QueryObject\Translator\Event\ConditionQueryTranslatorQuery;
use QueryObject\Translator\Event\QueryTranslatorEvent;
use QueryObject\Translator\Exception\QueryTranslationException;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class AbstractQueryTranslator implements QueryTranslatorInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher = null)
    {
        $this->eventDispatcher = $eventDispatcher ?: new EventDispatcher();
        $this->init();
    }

    protected function init()
    {

    }

    /**
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }

    protected function translateCondition(Query $query, ConditionInterface $condition)
    {
        $event = $this->createTranslateConditionEvent($query, $condition);
        $this->eventDispatcher->dispatch(
            QueryTranslatorEvent::TRANSLATE_CONDITION,
            $event
        );

        if (!$event->isHandled()) {
            $msg = sprintf(
                'Could not translate query condition of class. None of %s listeners was able to translate it.',
                get_class($condition), QueryTranslatorEvent::TRANSLATE_CONDITION
            );
            throw new QueryTranslationException($msg);
        }
    }

    protected function createTranslateConditionEvent(Query $query, ConditionInterface $condition)
    {
        return new QueryTranslatorEvent($query, $condition);
    }

    protected function translateQuery(Query $query)
    {
        $event = $this->createTranslateQueryEvent($query);
        $this->eventDispatcher->dispatch(
            QueryTranslatorEvent::TRANSLATE_QUERY,
            $event
        );

        if (!$event->isHandled()) {
            $msg = sprintf(
                'Could not translate query. None of %s listeners was able to translate it',
                QueryTranslatorEvent::TRANSLATE_QUERY
            );
            throw new QueryTranslationException($msg);
        }
    }

    protected function createTranslateQueryEvent(Query $query)
    {
        return new QueryTranslatorEvent($query);
    }

    protected function runTranslation(Query $query)
    {
        $this->translateQuery($query);
        foreach ($query->getConditions() as $condition) {
            $this->translateCondition($query, $condition);
        }
    }
}