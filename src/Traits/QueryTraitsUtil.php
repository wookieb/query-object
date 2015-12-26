<?php

namespace QueryObject\Traits;


use PhpOption\Option;
use QueryObject\Condition\ConditionInterface;

class QueryTraitsUtil
{
    /**
     * @param Option $option
     * @param string $className
     * @return Option
     */
    public static function filterConditionByClass(Option $option, $className)
    {
        return $option->filter(function (ConditionInterface $condition) use ($className) {
            return $condition instanceof $className;
        });
    }
}