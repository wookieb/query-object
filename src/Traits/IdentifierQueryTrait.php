<?php

namespace QueryObject\Traits;


use QueryObject\Condition\IdentifierCondition;

trait IdentifierQueryTrait
{
    public function byId($id)
    {
        $this->addCondition(new IdentifierCondition($id), '__id');
    }

    public function getId()
    {
        return QueryTraitsUtil::filterConditionByClass(
            $this->getConditionByName('__id'),
            'QueryObject\Condition\IdentifierCondition::__construct'
        )
            ->map(function (IdentifierCondition $condition) {
                return $condition->getId();
            })
            ->getOrElse(null);
    }
}