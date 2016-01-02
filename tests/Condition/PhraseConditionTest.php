<?php

namespace QueryObject\Tests\Condition;

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
        $this->assertTrue($object->isContains());
        $this->assertFalse($object->isEndWith());
        $this->assertFalse($object->isStartWith());
    }

    public function testCreationOfFieldStartsWith()
    {
        $object = PhraseCondition::startsWith(self::FIELD, self::PHRASE);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::PHRASE, $object->getPhrase());
        $this->assertSame(PhraseCondition::STARTS_WITH, $object->getMode());
        $this->assertFalse($object->isContains());
        $this->assertFalse($object->isEndWith());
        $this->assertTrue($object->isStartWith());
    }

    public function testCreateOfFieldEndsWith()
    {
        $object = PhraseCondition::endsWith(self::FIELD, self::PHRASE);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::PHRASE, $object->getPhrase());
        $this->assertSame(PhraseCondition::ENDS_WITH, $object->getMode());
        $this->assertFalse($object->isContains());
        $this->assertTrue($object->isEndWith());
        $this->assertFalse($object->isStartWith());
    }


    public function testThrowsAnExceptionIfFieldNameIsBlank()
    {
        $this->runTestFieldNotBlank(function () {
            PhraseCondition::contains('   ', self::PHRASE);
        });
    }
}