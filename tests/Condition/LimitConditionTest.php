<?php

namespace QueryObject\Tests\Condition;


use QueryObject\Condition\LimitCondition;

class LimitConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreation()
    {
        $limit = 100;
        $object = new LimitCondition($limit);
        $this->assertSame($limit, $object->getLimit());
    }

    public function invalidLimitProvider()
    {
        return [
            [0],
            [''],
            [-1],
        ];
    }

    /**
     * @dataProvider invalidLimitProvider
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage  Limit must be greater than 0
     */
    public function testThrowsExceptionIfLimitIsLowerOrEqual0($limit)
    {
        new LimitCondition($limit);
    }
}