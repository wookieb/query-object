<?php

namespace QueryObject\Tests\Translator\Event;


use QueryObject\Condition\ConditionInterface;
use QueryObject\Query;
use QueryObject\Translator\Event\QueryTranslatorEvent;
use QueryObject\Translator\TranslationContext;
use Symfony\Component\EventDispatcher\Event;

class QueryTranslatorEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QueryTranslatorEvent
     */
    private $object;

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

    protected function setUp()
    {
        $this->query = new Query();
        $this->condition = $this->getMockForAbstractClass(ConditionInterface::class);
        $this->context = $this->getMock(TranslationContext::class);
        $this->object = new QueryTranslatorEvent($this->context, $this->query, $this->condition);
    }

    public function testExtendsEvent()
    {
        $this->assertInstanceOf(Event::class, $this->object);
    }

    public function testBasicGetters()
    {
        $this->assertSame($this->context, $this->object->getContext());
        $this->assertSame($this->query, $this->object->getQuery());
        $this->assertSame($this->condition, $this->object->getCondition());
        $this->assertFalse($this->object->isHandled());
    }

    public function testPropagationIsNotStoppedByDefault()
    {
        $this->assertFalse($this->object->isPropagationStopped());
    }

    public function testMarkingAsHandledMeansStopPropagation()
    {
        $this->object->markAsHandled();
        $this->assertTrue($this->object->isHandled());
        $this->assertTrue($this->object->isPropagationStopped());
    }
}