<?php

namespace QueryObject\Tests\Condition;

use QueryObject\Condition\SimpleOperatorCondition;

class SimpleOperatorConditionTest extends ConditionTest
{
    const FIELD = 'field-name';
    const VALUE = 100;

    protected function createValidCondition()
    {
        return SimpleOperatorCondition::equals(self::FIELD, self::VALUE);
    }

    public function testThrowsAnExceptionIfFieldNameIsBlank()
    {
        $this->runTestFieldNotBlank(function () {
            SimpleOperatorCondition::equals('   ', self::VALUE);
        });
    }

    public function testEquals()
    {
        $object = SimpleOperatorCondition::equals(self::FIELD, self::VALUE);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getValue());
        $this->assertSame(SimpleOperatorCondition::EQUAL, $object->getOperator());
        $this->assertTrue($object->isEqual());
        $this->assertFalse($object->isNotEqual());
        $this->assertFalse($object->isGreaterThan());
        $this->assertFalse($object->isGreaterThanOrEqual());
        $this->assertFalse($object->isLessThan());
        $this->assertFalse($object->isLessThanOrEqual());
    }

    public function testNotEqual()
    {
        $object = SimpleOperatorCondition::notEqual(self::FIELD, self::VALUE);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getValue());
        $this->assertSame(SimpleOperatorCondition::NOT_EQUAL, $object->getOperator());
        $this->assertFalse($object->isEqual());
        $this->assertTrue($object->isNotEqual());
        $this->assertFalse($object->isGreaterThan());
        $this->assertFalse($object->isGreaterThanOrEqual());
        $this->assertFalse($object->isLessThan());
        $this->assertFalse($object->isLessThanOrEqual());
    }

    public function testGreaterThan()
    {
        $object = SimpleOperatorCondition::greaterThan(self::FIELD, self::VALUE);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getValue());
        $this->assertSame(SimpleOperatorCondition::GREATER_THAN, $object->getOperator());
        $this->assertFalse($object->isEqual());
        $this->assertTrue($object->isGreaterThan());
        $this->assertFalse($object->isGreaterThanOrEqual());
        $this->assertFalse($object->isLessThan());
        $this->assertFalse($object->isLessThanOrEqual());
    }

    public function testGreaterThanOrEqual()
    {
        $object = SimpleOperatorCondition::greaterThanOrEqual(self::FIELD, self::VALUE);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getValue());
        $this->assertSame(SimpleOperatorCondition::GREATER_THAN_OR_EQUAL, $object->getOperator());
        $this->assertFalse($object->isEqual());
        $this->assertFalse($object->isNotEqual());
        $this->assertFalse($object->isGreaterThan());
        $this->assertTrue($object->isGreaterThanOrEqual());
        $this->assertFalse($object->isLessThan());
        $this->assertFalse($object->isLessThanOrEqual());
    }

    public function testLessThan()
    {
        $object = SimpleOperatorCondition::lessThan(self::FIELD, self::VALUE);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getValue());
        $this->assertSame(SimpleOperatorCondition::LESS_THAN, $object->getOperator());
        $this->assertFalse($object->isEqual());
        $this->assertFalse($object->isNotEqual());
        $this->assertFalse($object->isGreaterThan());
        $this->assertFalse($object->isGreaterThanOrEqual());
        $this->assertTrue($object->isLessThan());
        $this->assertFalse($object->isLessThanOrEqual());
    }

    public function testLessThanOrEqual()
    {
        $object = SimpleOperatorCondition::lessThanOrEqual(self::FIELD, self::VALUE);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getValue());
        $this->assertSame(SimpleOperatorCondition::LESS_THAN_OR_EQUAL, $object->getOperator());
        $this->assertFalse($object->isEqual());
        $this->assertFalse($object->isNotEqual());
        $this->assertFalse($object->isGreaterThan());
        $this->assertFalse($object->isGreaterThanOrEqual());
        $this->assertFalse($object->isLessThan());
        $this->assertTrue($object->isLessThanOrEqual());
    }
}