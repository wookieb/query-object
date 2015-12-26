<?php

namespace QueryObject\Tests;


use QueryObject\Condition\ConditionInterface;
use QueryObject\Query;
use QueryObject\Traits\IdentifierQueryTrait;
use QueryObject\Traits\LimitQueryTrait;
use QueryObject\Traits\OffsetQueryTrait;
use QueryObject\Traits\SortingQueryTrait;

class QueryBridge extends Query
{
    use LimitQueryTrait, OffsetQueryTrait, SortingQueryTrait, IdentifierQueryTrait;

    public function addCondition(ConditionInterface $condition, $name = null)
    {
        return parent::addCondition($condition, $name);
    }

    public function getConditionByName($name)
    {
        return parent::getConditionByName($name);
    }

    public function removeConditionByName($name)
    {
        return parent::removeConditionByName($name);
    }
}