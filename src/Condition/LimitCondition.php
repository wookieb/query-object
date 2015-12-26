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
        Assertion::integer($limit, null, 'LimitQueryTrait');
        Assertion::greaterThan($limit, 0, null, 'LimitQueryTrait');
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