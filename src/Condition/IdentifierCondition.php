<?php

namespace QueryObject\Condition;


use Assert\Assertion;

class IdentifierCondition implements ConditionInterface
{
    private $id;

    public function __construct($id)
    {
        Assertion::notEmpty($id, 'Id cannot be empty');
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}