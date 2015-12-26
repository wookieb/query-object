<?php

namespace QueryObject\Tests\Condition;


use QueryObject\Condition\PhraseCondition;

class PhraseConditionTest extends \PHPUnit_Framework_TestCase
{
    const FIELD = 'field-name';
    const PHRASE = 'phrase';

    public function testCreationOfFieldContains()
    {
        $object = new PhraseCondition(self::FIELD, self::PHRASE);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::PHRASE, $object->getPhrase());
        $this->assertSame(PhraseCondition::CONTAINS, $object->getMode());
        $this->assertTrue($object->isContainsMode());
        $this->assertFalse($object->isEndWithMode());
        $this->assertFalse($object->isStartWithMode());
    }

    public function testCreationOfFieldStartsWith()
    {
        $object = new PhraseCondition(self::FIELD, self::PHRASE, PhraseCondition::STARTS_WITH);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::PHRASE, $object->getPhrase());
        $this->assertSame(PhraseCondition::STARTS_WITH, $object->getMode());
        $this->assertFalse($object->isContainsMode());
        $this->assertFalse($object->isEndWithMode());
        $this->assertTrue($object->isStartWithMode());
    }

    public function testCreateOfFieldEndsWith()
    {
        $object = new PhraseCondition(self::FIELD, self::PHRASE, PhraseCondition::ENDS_WITH);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(self::PHRASE, $object->getPhrase());
        $this->assertSame(PhraseCondition::ENDS_WITH, $object->getMode());
        $this->assertFalse($object->isContainsMode());
        $this->assertTrue($object->isEndWithMode());
        $this->assertFalse($object->isStartWithMode());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Field name cannot be blank
     */
    public function testThrowsAnExceptionIfFieldNameIsBlank()
    {
        new PhraseCondition('  ', self::PHRASE);
    }

}