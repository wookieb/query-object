<?php

namespace QueryObject\Tests\Condition;


use QueryObject\Condition\ConditionInterface;
use QueryObject\Condition\PhraseCondition;

class PhraseConditionTest extends ConditionTest
{
    const FIELD = 'field-name';
    const PHRASE = 'phrase';

    protected function createValidCondition()
    {
        return PhraseCondition::contains(self::FIELD, self::PHRASE);
    }

    public function testCreationOfFieldContains()
    {
        $object = PhraseCondition::contains(self::FIELD, self::PHRASE);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::PHRASE, $object->getPhrase());
        $this->assertSame(PhraseCondition::CONTAINS, $object->getMode());
        $this->assertTrue($object->isContainsMode());
        $this->assertFalse($object->isEndWithMode());
        $this->assertFalse($object->isStartWithMode());
    }

    public function testCreationOfFieldStartsWith()
    {
        $object = PhraseCondition::startsWith(self::FIELD, self::PHRASE);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::PHRASE, $object->getPhrase());
        $this->assertSame(PhraseCondition::STARTS_WITH, $object->getMode());
        $this->assertFalse($object->isContainsMode());
        $this->assertFalse($object->isEndWithMode());
        $this->assertTrue($object->isStartWithMode());
    }

    public function testCreateOfFieldEndsWith()
    {
        $object = PhraseCondition::endsWith(self::FIELD, self::PHRASE);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::PHRASE, $object->getPhrase());
        $this->assertSame(PhraseCondition::ENDS_WITH, $object->getMode());
        $this->assertFalse($object->isContainsMode());
        $this->assertTrue($object->isEndWithMode());
        $this->assertFalse($object->isStartWithMode());
    }


    public function testThrowsAnExceptionIfFieldNameIsBlank()
    {
        $this->runTestFieldNotBlank(function () {
            PhraseCondition::contains('   ', self::PHRASE);
        });
    }
}