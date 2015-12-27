<?php

namespace QueryObject\Tests;


class StandardQueryTest extends \PHPUnit_Framework_TestCase
{
    public function testTraits()
    {
        $reflection = new \ReflectionClass('\QueryObject\StandardQuery');
        $this->assertInstanceOf('QueryObject\Query', $reflection->newInstance());
        $this->assertContains('QueryObject\Traits\LimitQueryTrait', $reflection->getTraitNames());
        $this->assertContains('QueryObject\Traits\OffsetQueryTrait', $reflection->getTraitNames());
        $this->assertContains('QueryObject\Traits\SortingQueryTrait', $reflection->getTraitNames());
    }
}