<?php

namespace QueryObject\Tests\Condition;


use QueryObject\Condition\EqualsCondition;

class EqualsConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreation()
    {
        $field = 'field-name';
        $value = 'value';
        $object = new EqualsCondition($field, $value);

        $this->assertSame($object->getField(), $field);
        $this->assertSame($object->getValue(), $value);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Field should not be blank
     */
    public function testThrowsExceptionForBlankFields()
    {
        new EqualsCondition('  ', 'value');
    }
}