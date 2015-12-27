<?php

namespace QueryObject\Traits;


use QueryObject\Condition\SortingCondition;
use QueryObject\Condition\SortingDefinition;

trait SortingQueryTrait
{
    /**
     * @return SortingCondition
     */
    private function __getSortingCondition()
    {
        return QueryTraitsUtil::filterConditionByClass(
            $this->getConditionByName('__sort'),
            'QueryObject\Condition\SortingCondition'
        )
            ->getOrCall(function () {
                $condition = new SortingCondition();
                $this->addCondition($condition, '__sort');
                return $condition;
            });
    }

    /**
     * @param string|SortingDefinition $field
     * @param string $direction asc or desc
     * @param integer $position put sorting at given position
     * @return $this
     */
    public function sortBy($field, $direction, $position = null)
    {
        $this->__getSortingCondition()
            ->sortBy($field, $direction, $position);
        return $this;
    }

    public function getSorting()
    {
        return $this->__getSortingCondition()
            ->getSorting();
    }
}