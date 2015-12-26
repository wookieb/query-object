<?php

namespace QueryObject\Condition;

class SimpleOperatorCondition implements ConditionInterface
{
    const EQUAL = 'equal';
    const NOT_EQUAL = 'not-equal';
    const GREATER_THAN = 'greater-than';
    const GREATER_THAN_OR_EQUAL = 'greater-than-or-equal';
    const LESS_THAN = 'less-than';
    const LESS_THAN_OR_EQUAL = 'less-than-or-equal';

    /**
     * @var
     */
    private $field;
    /**
     * @var
     */
    private $value;
    /**
     * @var
     */
    private $operator;

    /**
     * SimpleOperatorCondition constructor.
     * @param $field
     * @param $value
     * @param $operator
     */
    private function __construct($field, $value, $operator)
    {
        ConditionsUtil::assertFieldName($field);
        $this->field = $field;
        $this->value = $value;
        $this->operator = $operator;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $field
     * @param mixed $value
     * @return SimpleOperatorCondition
     */
    public static function equals($field, $value)
    {
        return new self($field, $value, self::EQUAL);
    }

    public static function notEqual($field, $value)
    {
        return new self($field, $value, self::NOT_EQUAL);
    }

    /**
     * @param string $field
     * @param mixed $value
     * @return SimpleOperatorCondition
     */
    public static function greaterThan($field, $value)
    {
        return new self($field, $value, self::GREATER_THAN);
    }

    /**
     * @param string $field
     * @param mixed $value
     * @return SimpleOperatorCondition
     */
    public static function greaterThanOrEqual($field, $value)
    {
        return new self($field, $value, self::GREATER_THAN_OR_EQUAL);
    }

    /**
     * @param string $field
     * @param mixed $value
     * @return SimpleOperatorCondition
     */
    public static function lessThan($field, $value)
    {
        return new self($field, $value, self::LESS_THAN);
    }

    /**
     * @param string $field
     * @param mixed $value
     * @return SimpleOperatorCondition
     */
    public static function lessThanOrEqual($field, $value)
    {
        return new self($field, $value, self::LESS_THAN_OR_EQUAL);
    }

    public function isEqual()
    {
        return $this->operator === self::EQUAL;
    }

    public function isNotEqual()
    {
        return $this->operator === self::NOT_EQUAL;
    }

    public function isGreaterThan()
    {
        return $this->operator === self::GREATER_THAN;
    }

    public function isGreaterThanOrEqual()
    {
        return $this->operator === self::GREATER_THAN_OR_EQUAL;
    }

    public function isLessThan()
    {
        return $this->operator === self::LESS_THAN;
    }

    public function isLessThanOrEqual()
    {
        return $this->operator === self::LESS_THAN_OR_EQUAL;
    }
}