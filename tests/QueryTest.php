<?php

namespace QueryObject\Tests;

use PhpOption\None;
use PhpOption\Some;
use QueryObject\Condition\ConditionInterface;
use QueryObject\Tests\TestResources\QueryBridge;

class QueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QueryBridge
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
        $this->object = new QueryBridge();

        $this->condition = $this->getMockForAbstractClass('QueryObject\Condition\ConditionInterface');
        $this->condition2 = $this->getMockForAbstractClass('QueryObject\Condition\ConditionInterface');
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
        $this->setExpectedException('\InvalidArgumentException', 'Condition "'.self::CONDITION_NAME.'" does not exist');

        $this->object->removeConditionByName(self::CONDITION_NAME);
    }
}