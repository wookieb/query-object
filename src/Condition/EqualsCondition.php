<?php

namespace QueryObject\Condition;

use Assert\Assertion;

class EqualsCondition implements ConditionInterface
{
    /**
     * @var string
     */
    private $field;
    /**
     * @var mixed
     */
    private $value;

    public function __construct($field, $value)
    {
        Assertion::notBlank($field, 'Field should not be blank');
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return string
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
}