<?php

namespace QueryObject\Tests\Condition;


use Prophecy\Exception\InvalidArgumentException;
use QueryObject\Condition\IdentifierCondition;

class IdentifierConditionTest extends \PHPUnit_Framework_TestCase
{
    public function validIdentifiers()
    {
        return [
            [1],
            [array('composite', 'key')],
            ['hash']
        ];
    }

    /**
     * @dataProvider validIdentifiers
     */
    public function testCreation($id)
    {
        $object = new IdentifierCondition($id);
        $this->assertSame($id, $object->getId());
    }


    public function invalidIdentifiers()
    {
        return [
            [0],
            [''],
            [[]]
        ];
    }

    /**
     * @dataProvider invalidIdentifiers
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Id cannot be empty
     */
    public function testThrowsExceptionForInvalidId($id)
    {
        new IdentifierCondition($id);
    }
}