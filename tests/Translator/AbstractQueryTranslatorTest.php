<?php

namespace QueryObject\Tests\Translator;


use QueryObject\Condition\ConditionInterface;
use QueryObject\Query;
use QueryObject\Tests\TestResources\QueryBridge;
use QueryObject\Tests\TestResources\QueryTranslatorBridge;
use QueryObject\Translator\Event\QueryTranslatorEvent;
use QueryObject\Translator\Exception\QueryTranslationException;

class AbstractQueryTranslatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QueryTranslatorBridge
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

    protected function setUp()
    {
        $this->conditionEventObjects = [];
        $this->queryEventObject = null;

        $this->object = new QueryTranslatorBridge();
        $this->object->getEventDispatcher()
            ->addListener(QueryTranslatorEvent::TRANSLATE_CONDITION, [$this, 'onCondition']);
        $this->object->getEventDispatcher()
            ->addListener(QueryTranslatorEvent::TRANSLATE_QUERY, [$this, 'onQuery']);

        $this->condition1 = $this->getMockForAbstractClass('QueryObject\Condition\ConditionInterface');
        $this->condition2 = $this->getMockForAbstractClass('QueryObject\Condition\ConditionInterface');

        $this->query = new QueryBridge();
        $this->query->addCondition($this->condition1);
        $this->query->addCondition($this->condition2);
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
            new QueryTranslatorEvent($this->query),
            $this->queryEventObject
        );

        $this->assertEquals([
            $this->createHandledEvent($this->query, $this->condition1),
            $this->createHandledEvent($this->query, $this->condition2)
        ], $this->conditionEventObjects);
    }

    private function createHandledEvent(Query $query, ConditionInterface $condition = null)
    {
        $event = new QueryTranslatorEvent($query, $condition);
        $event->markAsHandled();
        return $event;
    }

    public function testQueryEventListenerHandlesTranslation()
    {
        $this->object->getEventDispatcher()
            ->addListener(QueryTranslatorEvent::TRANSLATE_QUERY, function (QueryTranslatorEvent $event) {
                $event->markAsHandled();
            }, 100);

        $this->object->translate($this->query);

        $this->assertNull($this->queryEventObject, 'Standard query listener should not be called');
        $this->assertEquals([], $this->conditionEventObjects, 'Standard condition listeners should not be called');
    }

    public function testConditionEventListenerHandlesOneTranslation()
    {
        $this->object->getEventDispatcher()
            ->addListener(QueryTranslatorEvent::TRANSLATE_CONDITION, function (QueryTranslatorEvent $event) {
                if ($event->getCondition() === $this->condition1) {
                    $event->markAsHandled();
                }
            }, 100);

        $this->object->translate($this->query);
        $this->assertEquals(
            new QueryTranslatorEvent($this->query),
            $this->queryEventObject
        );

        $this->assertEquals([
            $this->createHandledEvent($this->query, $this->condition2)
        ], $this->conditionEventObjects);
    }

    /**
     * @expectedException QueryObject\Translator\Exception\QueryTranslationException
     * @expectedExceptionMessageRegExp /Could not translate query condition of .*?\. None of translate:condition listeners was able to translate it\./
     */
    public function testThrowsAnExceptionIfConditionEventWasNotHandled()
    {
        $this->object->getEventDispatcher()->removeListener(
            QueryTranslatorEvent::TRANSLATE_CONDITION,
            [$this, 'onCondition']
        );

        $this->object->translate($this->query);
    }
}