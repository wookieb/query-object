<?php

namespace QueryObject\Tests\TestResources;


use QueryObject\Condition\ConditionInterface;
use QueryObject\Query;
use QueryObject\Traits\LimitQueryTrait;
use QueryObject\Traits\OffsetQueryTrait;
use QueryObject\Traits\SortingQueryTrait;

class DummyQuery extends Query
{
    use LimitQueryTrait, OffsetQueryTrait, SortingQueryTrait;

    public function addCondition(ConditionInterface $condition, $name = null)
    {
        parent::addCondition($condition, $name);
    }

    public function getConditionByName($name)
    {
        return parent::getConditionByName($name);
    }

    public function removeConditionByName($name)
    {
        parent::removeConditionByName($name);
    }
}