<?php

namespace QueryObject\Tests\Condition;


use QueryObject\Condition\BetweenCondition;

class BetweenConditionTest extends ConditionTest
{
    const FIELD = 'some-field';

    protected function createValidCondition()
    {
        return new BetweenCondition(self::FIELD, 0, 100);
    }

    public function testThrowsAnExceptionIfFieldIsBlank()
    {
        $this->runTestFieldNotBlank(function () {
            new BetweenCondition('  ', 0, 100);
        });
    }

    public function testCreation()
    {
        $object = $this->createValidCondition();
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(0, $object->getFrom());
        $this->assertSame(100, $object->getTo());
    }
}