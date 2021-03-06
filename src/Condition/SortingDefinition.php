<?php

namespace QueryObject\Condition;

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
        ConditionsUtil::assertFieldName($field);
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

    public function isAscending()
    {
        return $this->direction === self::ASC;
    }

    public function isDescending()
    {
        return $this->direction === self::DESC;
    }
}