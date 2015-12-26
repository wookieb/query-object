<?php

namespace QueryObject\Tests\Condition;


use QueryObject\Condition\ConditionInterface;
use QueryObject\Condition\DefinedCondition;

class DefinedConditionTest extends ConditionTest
{
    const FIELD = 'some-field';

    protected function createValidCondition()
    {
        return DefinedCondition::defined(self::FIELD);
    }

    public function testThrowsAnExceptionIfFieldNameIsBlank()
    {
        $this->runTestFieldNotBlank(function () {
            DefinedCondition::defined('   ');
        });
    }

    public function testDefined()
    {
        $object = DefinedCondition::defined(self::FIELD);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertTrue($object->isDefined());
        $this->assertFalse($object->isNotDefined());
    }

    public function testNotDefined()
    {
        $object = DefinedCondition::notDefined(self::FIELD);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertFalse($object->isDefined());
        $this->assertTrue($object->isNotDefined());
    }
}

