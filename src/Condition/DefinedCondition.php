<?php

namespace QueryObject\Condition;

class DefinedCondition implements ConditionInterface
{
    /**
     * @var string
     */
    private $field;
    /**
     * @var bool
     */
    private $negation;

    private function __construct($field, $negation)
    {
        ConditionsUtil::assertFieldName($field);
        $this->field = $field;
        $this->negation = !!$negation;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    public static function defined($field)
    {
        return new self($field, false);
    }

    public static function notDefined($field)
    {
        return new self($field, true);
    }

    public function isDefined()
    {
        return !$this->negation;
    }

    public function isNotDefined()
    {
        return $this->negation;
    }
}