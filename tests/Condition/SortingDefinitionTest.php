<?php

namespace QueryObject\Tests\Condition;


use QueryObject\Condition\SortingDefinition;

class SortingDefinitionTest extends \PHPUnit_Framework_TestCase
{
    const FIELD = 'some-field';

    public function testAscCreation()
    {
        $object = new SortingDefinition(self::FIELD);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(SortingDefinition::ASC, $object->getDirection());
        $this->assertTrue($object->isAscending());
        $this->assertFalse($object->isDescending());
    }

    public function testDescCreation()
    {
        $object = new SortingDefinition(self::FIELD, SortingDefinition::DESC);
        $this->assertSame(self::FIELD, $object->getField());
        $this->assertSame(SortingDefinition::DESC, $object->getDirection());
        $this->assertFalse($object->isAscending());
        $this->assertTrue($object->isDescending());
    }


    public function directionCaseInsensitivity()
    {
        return [
            ['aSc', true],
            ['ASC', true],
            ['dEsC', false],
            ['DESC', false]
        ];
    }

    /**
     * @dataProvider directionCaseInsensitivity
     */
    public function testDirectionIgnoresCharactersCase($direction, $isAscending)
    {
        $object = new SortingDefinition(self::FIELD, $direction);
        if ($isAscending) {
            $this->assertTrue($object->isAscending());
            $this->assertFalse($object->isDescending());
        } else {
            $this->assertFalse($object->isAscending());
            $this->assertTrue($object->isDescending());
        }
    }
}