<?php


namespace QueryObject\Traits;

use QueryObject\Condition\LimitCondition;

trait LimitQueryTrait
{
    /**
     * @param integer $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->addCondition(new LimitCondition($limit), '__limit');
        return $this;
    }

    public function getLimit()
    {
        return QueryTraitsUtil::filterConditionByClass(
            $this->getConditionByName('__limit'),
            'QueryObject\Condition\LimitCondition'
        )
            ->map(function (LimitCondition $condition) {
                return $condition->getLimit();
            })
            ->getOrElse(0);
    }
}