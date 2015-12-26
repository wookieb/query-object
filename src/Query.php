<?php

namespace QueryObject;

use PhpOption\None;
use PhpOption\Option;
use PhpOption\Some;
use QueryObject\Condition\ConditionInterface;

class Query
{
    private $conditions;

    protected function addCondition(ConditionInterface $condition, $name = null)
    {
        if ($name) {
            $this->conditions[$name] = $condition;
        } else {
            $this->conditions[] = $condition;
        }
    }

    /**
     * @param string $name
     * @return Option
     */
    protected function getConditionByName($name)
    {
        if (isset($this->conditions[$name])) {
            return new Some($this->conditions[$name]);
        }
        return None::create();
    }

    protected function removeConditionByName($name)
    {
        if (isset($this->conditions[$name])) {
            unset($this->conditions[$name]);
        } else {
            $msg = sprintf('Condition "%s" does not exist', $name);
            throw new \InvalidArgumentException($msg);
        }
    }

    /**
     * @return ConditionInterface[]
     */
    public function getConditions()
    {
        return $this->conditions;
    }
}