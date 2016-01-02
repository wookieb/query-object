<?php

namespace QueryObject\Tests;


use QueryObject\Query;
use QueryObject\StandardQuery;
use QueryObject\Traits\LimitQueryTrait;
use QueryObject\Traits\OffsetQueryTrait;
use QueryObject\Traits\SortingQueryTrait;

class StandardQueryTest extends \PHPUnit_Framework_TestCase
{
    public function testTraits()
    {
        $reflection = new \ReflectionClass(StandardQuery::class);
        $this->assertInstanceOf(Query::class, $reflection->newInstance());
        $this->assertContains(LimitQueryTrait::class, $reflection->getTraitNames());
        $this->assertContains(OffsetQueryTrait::class, $reflection->getTraitNames());
        $this->assertContains(SortingQueryTrait::class, $reflection->getTraitNames());
    }
}