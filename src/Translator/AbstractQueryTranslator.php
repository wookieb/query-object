<?php

namespace QueryObject\Translator;


use QueryObject\Condition\ConditionInterface;
use QueryObject\Query;
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

    protected function runTranslation(Query $query)
    {
        $context = $this->createContext();
        if (!$this->translateQuery($context, $query)) {
            foreach ($query->getConditions() as $condition) {
                if (!$context->isConditionHandled($condition)) {
                    $this->translateCondition($context, $query, $condition);
                }
            }
        }
    }

    protected function createContext()
    {
        return new TranslationContext();
    }

    protected function translateQuery(TranslationContext $context, Query $query)
    {
        $event = $this->createTranslateQueryEvent($context, $query);
        $this->eventDispatcher->dispatch(
            QueryTranslatorEvent::TRANSLATE_QUERY,
            $event
        );

        return $event->isHandled();
    }

    protected function createTranslateQueryEvent(TranslationContext $context, Query $query)
    {
        return new QueryTranslatorEvent($context, $query);
    }

    protected function translateCondition(TranslationContext $context, Query $query, ConditionInterface $condition)
    {
        $event = $this->createTranslateConditionEvent($context, $query, $condition);
        $this->eventDispatcher->dispatch(
            QueryTranslatorEvent::TRANSLATE_CONDITION,
            $event
        );

        if (!$event->isHandled()) {
            $msg = sprintf(
                'Could not translate query condition of class %s. None of %s listeners was able to translate it.',
                get_class($condition), QueryTranslatorEvent::TRANSLATE_CONDITION
            );
            throw new QueryTranslationException($msg);
        } else {
            if (!$context->isConditionHandled($condition)) {
                $context->markConditionAsHandled($condition);
            }
        }
    }

    protected function createTranslateConditionEvent(TranslationContext $context, Query $query, ConditionInterface $condition)
    {
        return new QueryTranslatorEvent($context, $query, $condition);
    }
}