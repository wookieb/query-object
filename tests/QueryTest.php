<?php

namespace QueryObject\Tests;

use PhpOption\None;
use PhpOption\Some;
use QueryObject\Condition\ConditionInterface;
use QueryObject\Tests\TestResources\DummyQuery;

class QueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DummyQuery
     */
    private $object;
    /**
     * @var ConditionInterface
     */
    private $condition;
    private $condition2;

    const CONDITION_NAME = 'condition-name';

    protected function setUp()
    {
        $this->object = new DummyQuery();

        $this->condition = $this->getMockForAbstractClass(ConditionInterface::class);
        $this->condition2 = $this->getMockForAbstractClass(ConditionInterface::class);
    }

    public function testAddingCondition()
    {
        $this->object->addCondition($this->condition);
        $this->assertSame([$this->condition], $this->object->getConditions());
    }

    public function testAddingConditionByName()
    {
        $this->object->addCondition($this->condition, self::CONDITION_NAME);

        $this->assertSame(
            [self::CONDITION_NAME => $this->condition],
            $this->object->getConditions()
        );
    }

    public function testAddingConditionWithTheSameNameOverridesPreviousOne()
    {
        $this->object->addCondition($this->condition, self::CONDITION_NAME);
        $this->object->addCondition($this->condition2, self::CONDITION_NAME);

        $this->assertSame(
            [self::CONDITION_NAME => $this->condition2],
            $this->object->getConditions()
        );
    }

    public function testGetConditionByNameReturnsSomeOptionIfConditionExists()
    {
        $this->object->addCondition($this->condition, self::CONDITION_NAME);

        $this->assertEquals(new Some($this->condition), $this->object->getConditionByName(self::CONDITION_NAME));
    }

    public function testGetConditionByNameReturnsNoneOptionIfConditionDoesNotExist()
    {
        $this->assertEquals(None::create(), $this->object->getConditionByName(self::CONDITION_NAME));
    }

    public function testRemovingCondition()
    {
        $this->object->addCondition($this->condition, self::CONDITION_NAME);
        $this->object->removeConditionByName(self::CONDITION_NAME);
        $this->assertSame([], $this->object->getConditions());
    }

    public function testRemovingNotDefinedConditionThrowsAnException()
    {
        $this->setExpectedException(\InvalidArgumentException::class, 'Condition "'.self::CONDITION_NAME.'" does not exist');

        $this->object->removeConditionByName(self::CONDITION_NAME);
    }
}