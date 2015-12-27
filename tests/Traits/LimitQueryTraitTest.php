<?php

namespace QueryObject\Tests\Traits;


use QueryObject\Condition\LimitCondition;
use QueryObject\Tests\TestResources\QueryBridge;

class LimitQueryTraitTest extends \PHPUnit_Framework_TestCase
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
        $result = $this->object->limit(100);
        $this->assertSame($this->object, $result);
        $this->assertContains(new LimitCondition(100), $this->object->getConditions(), '', false, false);
    }

    public function testGetting()
    {
        $this->object->limit(100);
        $this->assertSame(100, $this->object->getLimit());
    }
}