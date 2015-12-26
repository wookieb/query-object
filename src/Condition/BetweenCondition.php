<?php

namespace QueryObject\Condition;

class BetweenCondition implements ConditionInterface
{
    /**
     * @var string
     */
    private $field;
    /**
     * @var mixed
     */
    private $from;
    /**
     * @var mixed
     */
    private $to;

    public function __construct($field, $from, $to)
    {
        ConditionsUtil::assertFieldName($field);

        $this->field = $field;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

}