<?php

namespace QueryObject\Tests\Translator;


use QueryObject\Condition\ConditionInterface;
use QueryObject\Query;
use QueryObject\Tests\TestResources\DummyQuery;
use QueryObject\Tests\TestResources\DummyQueryTranslator;
use QueryObject\Translator\AbstractQueryTranslator;
use QueryObject\Translator\Event\QueryTranslatorEvent;
use QueryObject\Translator\Exception\QueryTranslationException;
use QueryObject\Translator\QueryTranslatorInterface;

class AbstractQueryTranslatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DummyQueryTranslator
     */
    private $object;

    /**
     * @var QueryTranslatorEvent[]
     */
    private $conditionEventObjects = [];
    /**
     * @var QueryTranslatorEvent
     */
    private $queryEventObject;
    /**
     * @var Query
     */
    private $query;
    /**
     * @var ConditionInterface
     */
    private $condition1;
    /**
     * @var ConditionInterface
     */
    private $condition2;
    private $customListenerCalled = false;

    protected function setUp()
    {
        $this->customListenerCalled = false;
        $this->conditionEventObjects = [];
        $this->queryEventObject = null;

        $this->object = new DummyQueryTranslator();
        $this->object->getEventDispatcher()
            ->addListener(QueryTranslatorEvent::TRANSLATE_CONDITION, [$this, 'onCondition'], -100);
        $this->object->getEventDispatcher()
            ->addListener(QueryTranslatorEvent::TRANSLATE_QUERY, [$this, 'onQuery'], -100);

        $this->condition1 = $this->getMockForAbstractClass(ConditionInterface::class);
        $this->condition2 = $this->getMockForAbstractClass(ConditionInterface::class);

        $this->query = new DummyQuery();
        $this->query->addCondition($this->condition1);
        $this->query->addCondition($this->condition2);
    }

    public function testClassHierarchy()
    {
        $object = $this->getMockForAbstractClass(AbstractQueryTranslator::class);
        $this->assertInstanceOf(QueryTranslatorInterface::class, $object);
    }

    public function onQuery(QueryTranslatorEvent $event)
    {
        $this->queryEventObject = $event;
    }

    public function onCondition(QueryTranslatorEvent $event)
    {
        $this->conditionEventObjects[] = $event;
        $event->markAsHandled();
    }

    public function testTranslationEvents()
    {
        $this->object->translate($this->query);

        $this->assertEquals(
            new QueryTranslatorEvent($this->object->context, $this->query),
            $this->queryEventObject
        );

        $this->assertEquals([
            $this->createHandledEvent($this->query, $this->condition1),
            $this->createHandledEvent($this->query, $this->condition2)
        ], $this->conditionEventObjects, 'The condition events were not dispatched');
    }

    private function createHandledEvent(Query $query, ConditionInterface $condition = null)
    {
        $event = new QueryTranslatorEvent($this->object->context, $query, $condition);
        $event->markAsHandled();
        return $event;
    }

    /**
     * @test if TRANSLATE_QUERY listener handles the query then none of other events gets dispatched
     */
    public function testQueryEventListenerHandlesTranslation()
    {
        $this->useCustomListenerForEvent(QueryTranslatorEvent::TRANSLATE_QUERY, function (QueryTranslatorEvent $event) {
            $event->markAsHandled();
        });

        $this->object->translate($this->query);

        $this->assertCustomListenerWasCalled();
        $this->assertNull($this->queryEventObject, 'Standard query listener should not be called');
        $this->assertEquals([], $this->conditionEventObjects, 'Standard condition listeners should not be called');
    }

    private function useCustomListenerForEvent($eventName, \Closure $listener)
    {
        $this->object->getEventDispatcher()->addListener($eventName, function () use ($listener) {
            $this->customListenerCalled = true;
            call_user_func_array($listener, func_get_args());
        });
    }

    private function assertCustomListenerWasCalled()
    {
        $this->assertTrue($this->customListenerCalled, 'Custom listener was not called');
    }

    /**
     * @test if TRANSLATE_CONDITION listener handles one of the condition then event for such condition is no longer propagated
     */
    public function testConditionEventListenerHandlesOneTranslation()
    {
        $this->useCustomListenerForEvent(QueryTranslatorEvent::TRANSLATE_CONDITION, function (QueryTranslatorEvent $event) {
            if ($event->getCondition() === $this->condition1) {
                $event->markAsHandled();
            }
        });

        $this->object->translate($this->query);
        $this->assertCustomListenerWasCalled();
        $this->assertEquals(
            new QueryTranslatorEvent($this->object->context, $this->query),
            $this->queryEventObject
        );

        $this->assertEquals([
            $this->createHandledEvent($this->query, $this->condition2)
        ], $this->conditionEventObjects);
    }

    /**
     * @expectedExceptionMessageRegExp /Could not translate query condition of .*?\. None of translate:condition listeners was able to translate it\./
     */
    public function testThrowsAnExceptionIfConditionEventWasNotHandled()
    {
        $this->setExpectedException(QueryTranslationException::class);
        $this->object->getEventDispatcher()->removeListener(
            QueryTranslatorEvent::TRANSLATE_CONDITION,
            [$this, 'onCondition']
        );

        $this->object->translate($this->query);
    }

    public function testMarkingTranslateConditionEventAsHandledShouldMarkConditionAsMarkedInContext()
    {
        $this->useCustomListenerForEvent(QueryTranslatorEvent::TRANSLATE_CONDITION, function (QueryTranslatorEvent $event) {
            if ($event->getCondition() === $this->condition1) {
                $event->markAsHandled();
            }
        });

        $this->object->translate($this->query);
        $this->assertCustomListenerWasCalled();
        $this->assertTrue($this->object->context->isConditionHandled($this->condition1));
        $this->assertTrue($this->object->context->isConditionHandled($this->condition2));
    }

    /**
     * @test if listener for TRANSLATE_QUERY marks condition as handled (in context) then TRANSLATE_EVENT wont be dispatched for this condition
     */
    public function testMarkingConditionAsHandledFromTranslateQueryEvent()
    {
        $this->useCustomListenerForEvent(QueryTranslatorEvent::TRANSLATE_QUERY, function (QueryTranslatorEvent $event) {
            $event->getContext()->markConditionAsHandled($this->condition1);
        });
        $this->object->translate($this->query);
        $this->assertCustomListenerWasCalled();
        $this->assertEquals([
            $this->createHandledEvent($this->query, $this->condition2)
        ], $this->conditionEventObjects);
    }
}