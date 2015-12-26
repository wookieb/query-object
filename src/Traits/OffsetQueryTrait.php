<?php


namespace QueryObject\Traits;

use QueryObject\Condition\OffsetCondition;

trait OffsetQueryTrait
{
    /**
     * @param integer $offset
     * @return $this
     */
    public function offset($offset)
    {
        $this->addCondition(new OffsetCondition($offset), '__offset');
        return $this;
    }

    public function getOffset()
    {
        return QueryTraitsUtil::filterConditionByClass(
            $this->getConditionByName('__offset'),
            'QueryObject\Condition\OffsetCondition'
        )
            ->map(function (OffsetCondition $condition) {
                return $condition->getOffset();
            })
            ->getOrElse(null);
    }
}