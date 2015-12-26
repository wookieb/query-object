<?php

namespace QueryObject\Condition;


use Assert\Assertion;

class SortingDefinition
{
    const ASC = 'asc';
    const DESC = 'desc';
    /**
     * @var string
     */
    private $field;
    /**
     * @var string
     */
    private $direction;

    public function __construct($field, $direction = 'asc')
    {
        Assertion::notBlank($field, 'SortingQueryTrait field cannot be blank');
        $this->field = $field;

        $direction = strtolower($direction);
        if ($direction !== self::DESC) {
            $direction = self::ASC;
        }
        $this->direction = $direction;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }
}