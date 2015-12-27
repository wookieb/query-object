<?php

namespace QueryObject\Tests\Traits;


use QueryObject\Condition\LimitCondition;
use QueryObject\Condition\OffsetCondition;
use QueryObject\Tests\TestResources\QueryBridge;

class OffsetQueryTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QueryBridge
     */
    private $object;

    protected function setUp()
    {
        $this->object = new QueryBridge();
    }

    public function testSetting()
    {
        $result = $this->object->offset(100);
        $this->assertSame($this->object, $result);
        $this->assertContains(new OffsetCondition(100), $this->object->getConditions(), '', false, false);
    }

    public function testGetting()
    {
        $this->object->offset(100);
        $this->assertSame(100, $this->object->getOffset());
    }
}