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
        Assertion::integer($offset, null, 'OffsetQueryTrait');
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