<?php

namespace QueryObject\Tests\Traits;


use QueryObject\Condition\SortingCondition;
use QueryObject\Condition\SortingDefinition;
use QueryObject\Tests\TestResources\QueryBridge;

class SortingQueryTraitTest extends \PHPUnit_Framework_TestCase
{
    const FIELD = 'some-field';

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
        $result = $this->object->sortBy(self::FIELD, 'asc');
        $this->assertSame($this->object, $result);

        $this->assertContains(new SortingCondition([
            new SortingDefinition(self::FIELD, 'asc')
        ]), $this->object->getConditions(), '', false, false);
    }

    public function testGetting()
    {
        $this->object->sortBy(self::FIELD, 'asc');
        $this->assertEquals([
            new SortingDefinition(self::FIELD, 'asc')
        ], $this->object->getSorting());
    }
}