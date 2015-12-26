<?php

namespace QueryObject\Condition;


use Assert\Assertion;

class LimitCondition implements ConditionInterface
{

    /**
     * @var integer
     */
    private $limit;

    public function __construct($limit)
    {
        $limit = (int)$limit;
        Assertion::greaterThan($limit, 0, 'Limit must be greater than 0');
        $this->limit = $limit;
    }

    /**
     * @return integer
     */
    public function getLimit()
    {
        return $this->limit;
    }
}