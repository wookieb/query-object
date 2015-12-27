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

    private $isNegation = false;

    private function __construct($field, $from, $to, $negation)
    {
        ConditionsUtil::assertFieldName($field);

        $this->field = $field;
        $this->from = $from;
        $this->to = $to;
        $this->isNegation = $negation;
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

    /**
     * @return bool
     */
    public function isNegation()
    {
        return $this->isNegation;
    }

    /**
     * @param string $field
     * @param mixed $from
     * @param mixed $to
     * @return BetweenCondition
     */
    public static function between($field, $from, $to)
    {
        return new BetweenCondition($field, $from, $to, false);
    }

    /**
     * @param string $field
     * @param mixed $from
     * @param mixed $to
     * @return BetweenCondition
     */
    public static function notBetween($field, $from, $to)
    {
        return new BetweenCondition($field, $from, $to, true);
    }
}