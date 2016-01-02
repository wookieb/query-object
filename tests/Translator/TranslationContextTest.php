<?php

namespace QueryObject\Tests\Translator;


use QueryObject\Condition\ConditionInterface;
use QueryObject\Translator\TranslationContext;

class TranslationContextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TranslationContext
     */
    private $object;

    private $condition;

    protected function setUp()
    {
        $this->object = new TranslationContext();
        $this->condition = $this->getMockForAbstractClass(ConditionInterface::class);
    }

    public function testMarkingConditionAdHandled()
    {
        $this->object->markConditionAsHandled($this->condition);
        $this->assertTrue($this->object->isConditionHandled($this->condition));
    }

    public function testIsConditionHandledChecksHandledConditionsStrictly()
    {
        $this->object->markConditionAsHandled($this->condition);
        $condition = $this->getMockForAbstractClass(ConditionInterface::class);
        $this->assertFalse($this->object->isConditionHandled($condition));
    }
}