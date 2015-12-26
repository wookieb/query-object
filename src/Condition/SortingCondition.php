<?php

namespace QueryObject\Condition;


use Assert\Assertion;

class SortingCondition implements ConditionInterface
{
    /**
     * @var SortingDefinition
     */
    private $sorting = [];

    public function __construct($sorting = [])
    {
        Assertion::allIsInstanceOf($sorting, 'QueryObject\Condition\SortingDefinition');
        $this->sorting = $sorting;
    }

    /**
     * @return SortingDefinition[]
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    public function sortBy($field, $order, $position = null)
    {
        if ($field instanceof SortingDefinition) {
            $definition = $field;
        } else {
            $definition = new SortingDefinition($field, $order);
        }

        if ($position) {
            $this->sorting[$position] = $definition;
        } else {
            $this->sorting[] = $definition;
        }
    }
}