<?php

namespace QueryObject\Tests\Condition;


use QueryObject\Condition\BetweenCondition;
use QueryObject\Condition\Conditions;
use QueryObject\Condition\DefinedCondition;
use QueryObject\Condition\PhraseCondition;
use QueryObject\Condition\SimpleOperatorCondition;

class ConditionsTest extends \PHPUnit_Framework_TestCase
{
    const FIELD = 'some-field';
    const VALUE = 'some-value';

    public function testEquals()
    {
        $object = Conditions::equals(self::FIELD, self::VALUE);
        $this->assertInstanceOf(SimpleOperatorCondition::class, $object);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getValue());
        $this->assertTrue($object->isEqual());
    }

    public function testNotEqual()
    {
        $object = Conditions::notEqual(self::FIELD, self::VALUE);
        $this->assertInstanceOf(SimpleOperatorCondition::class, $object);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getValue());
        $this->assertTrue($object->isNotEqual());
    }

    public function testGreaterThan()
    {
        $object = Conditions::greaterThan(self::FIELD, self::VALUE);
        $this->assertInstanceOf(SimpleOperatorCondition::class, $object);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getValue());
        $this->assertTrue($object->isGreaterThan());
    }

    public function testGreaterThanOrEqual()
    {
        $object = Conditions::greaterThanOrEqual(self::FIELD, self::VALUE);
        $this->assertInstanceOf(SimpleOperatorCondition::class, $object);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getValue());
        $this->assertTrue($object->isGreaterThanOrEqual());
    }

    public function testLessThan()
    {
        $object = Conditions::lessThan(self::FIELD, self::VALUE);
        $this->assertInstanceOf(SimpleOperatorCondition::class, $object);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getValue());
        $this->assertTrue($object->isLessThan());
    }

    public function testLessThanOrEqual()
    {
        $object = Conditions::lessThanOrEqual(self::FIELD, self::VALUE);
        $this->assertInstanceOf(SimpleOperatorCondition::class, $object);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getValue());
        $this->assertTrue($object->isLessThanOrEqual());
    }

    public function testStartsWith()
    {
        $object = Conditions::startsWithPhrase(self::FIELD, self::VALUE);
        $this->assertInstanceOf(PhraseCondition::class, $object);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getPhrase());
        $this->assertTrue($object->isStartWith());
    }

    public function testContains()
    {
        $object = Conditions::containsPhrase(self::FIELD, self::VALUE);
        $this->assertInstanceOf(PhraseCondition::class, $object);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getPhrase());
        $this->assertTrue($object->isContains());
    }

    public function testEndsWith()
    {
        $object = Conditions::endsWithPhrase(self::FIELD, self::VALUE);
        $this->assertInstanceOf(PhraseCondition::class, $object);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::VALUE, $object->getPhrase());
        $this->assertTrue($object->isEndWith());
    }

    public function testDefined()
    {
        $object = Conditions::defined(self::FIELD);
        $this->assertInstanceOf(DefinedCondition::class, $object);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertTrue($object->isDefined());
    }

    public function testNotDefined()
    {
        $object = Conditions::notDefined(self::FIELD);
        $this->assertInstanceOf(DefinedCondition::class, $object);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertTrue($object->isNotDefined());
    }

    public function testBetween()
    {
        $object = Conditions::between(self::FIELD, 0, 100);
        $this->assertInstanceOf(BetweenCondition::class, $object);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(0, $object->getFrom());
        $this->assertSame(100, $object->getTo());
        $this->assertFalse($object->isNegation());
    }

    public function testNotBetween()
    {
        $object = Conditions::notBetween(self::FIELD, 0, 100);
        $this->assertInstanceOf(BetweenCondition::class, $object);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(0, $object->getFrom());
        $this->assertSame(100, $object->getTo());
        $this->assertTrue($object->isNegation());
    }
}