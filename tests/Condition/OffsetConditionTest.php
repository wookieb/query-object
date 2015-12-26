<?php

namespace QueryObject\Tests\Condition;


use QueryObject\Condition\OffsetCondition;

class OffsetConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreation()
    {
        $offset = 100;
        $object = new OffsetCondition($offset);
        $this->assertSame($offset, $object->getOffset());
    }

    public function invalidOffsets()
    {
        return [
            [-1],
            ['-2']
        ];
    }

    /**
     * @dataProvider invalidOffsets
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Offset cannot be lower than 0
     */
    public function testThrowsAnExceptionIfOffsetIsLowerThan0($offset)
    {
        new OffsetCondition($offset);
    }
}