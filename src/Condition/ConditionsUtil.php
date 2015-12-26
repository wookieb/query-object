<?php

namespace QueryObject\Condition;


use Assert\Assertion;

class ConditionsUtil
{
    public static function assertFieldName($fieldName) {
        Assertion::notBlank($fieldName, 'Field name should not be blank');
    }
}