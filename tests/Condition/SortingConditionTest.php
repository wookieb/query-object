<?php

namespace QueryObject\Tests\Condition;


use QueryObject\Condition\SortingCondition;
use QueryObject\Condition\SortingDefinition;

class SortingConditionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SortingCondition
     */
    private $object;

    const FIELD = 'some-field';
    const FIELD_2 = 'some-field_2';

    protected function setUp()
    {
        $this->object = new SortingCondition();
    }

    public function testCreation()
    {
        $sortingDefinition = new SortingDefinition(self::FIELD);
        $object = new SortingCondition([
            $sortingDefinition
        ]);

        $this->assertSame([$sortingDefinition], $object->getSorting());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Provided sorting must be an array of QueryObject\Condition\SortingDefinition
     */
    public function testThrowsAnExceptionIfProvidedSortingIsNotAnArrayOfSortingDefinition()
    {
        new SortingCondition([
            ['field', 'ASC']
        ]);
    }

    public function testSetSorting()
    {
        $this->object->sortBy(self::FIELD, 'ASC');
        $this->object->sortBy(self::FIELD_2, 'DESC');

        $this->assertEquals([
            new SortingDefinition(self::FIELD, 'ASC'),
            new SortingDefinition(self::FIELD_2, 'DESC')
        ], $this->object->getSorting());
    }

    public function testSetSortingByProvidingSortingDefinitionInstance()
    {
        $definition = new SortingDefinition(self::FIELD, 'ASC');
        $this->object->sortBy($definition, 'DESC');

        $this->assertEquals([
            $definition
        ], $this->object->getSorting());
    }

    public function testSetSortingAtPosition()
    {
        $this->object->sortBy(self::FIELD, 'ASC');
        $this->object->sortBy(self::FIELD_2, 'DESC');
        $this->object->sortBy(self::FIELD_2, 'ASC', 1); // override last one

        $this->assertEquals([
            new SortingDefinition(self::FIELD, 'ASC'),
            new SortingDefinition(self::FIELD_2, 'ASC')
        ], $this->object->getSorting());
    }
}