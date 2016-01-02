<?php

namespace QueryObject\Tests\Condition;


use QueryObject\Condition\ConditionInterface;

abstract class ConditionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return ConditionInterface
     */
    abstract protected function createValidCondition();

    public function testShouldImplementConditionInterface()
    {
        $this->assertInstanceOf(ConditionInterface::class, $this->createValidCondition());
    }

    protected function runTestFieldNotBlank(\Closure $closure)
    {
        $this->setExpectedException('\InvalidArgumentException', 'Field name should not be blank');
        $closure();
    }
}