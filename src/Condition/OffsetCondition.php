<?php

namespace QueryObject\Condition;


use Assert\Assertion;

class OffsetCondition implements ConditionInterface
{
    /**
     * @var integer
     */
    private $offset = 0;

    public function __construct($offset)
    {
        $offset = (int)$offset;
        Assertion::greaterOrEqualThan($offset, 0, 'Offset cannot be lower than 0');
        $this->offset = $offset;
    }

    /**
     * @return integer
     */
    public function getOffset()
    {
        return $this->offset;
    }

}