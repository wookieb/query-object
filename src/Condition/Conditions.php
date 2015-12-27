<?php

namespace QueryObject\Condition;

class Conditions
{
    /**
     * @param string $fieldName
     * @param mixed $value
     * @return SimpleOperatorCondition
     */
    public static function equals($fieldName, $value)
    {
        return SimpleOperatorCondition::equals($fieldName, $value);
    }

    /**
     * @param string $fieldName
     * @param mixed $value
     * @return SimpleOperatorCondition
     */
    public static function notEqual($fieldName, $value)
    {
        return SimpleOperatorCondition::notEqual($fieldName, $value);
    }

    /**
     * @param string $fieldName
     * @param mixed $value
     * @return SimpleOperatorCondition
     */
    public static function greaterThan($fieldName, $value)
    {
        return SimpleOperatorCondition::greaterThan($fieldName, $value);
    }

    /**
     * @param string $fieldName
     * @param mixed $value
     * @return SimpleOperatorCondition
     */
    public static function greaterThanOrEqual($fieldName, $value)
    {
        return SimpleOperatorCondition::greaterThanOrEqual($fieldName, $value);
    }

    /**
     * @param string $fieldName
     * @param mixed $value
     * @return SimpleOperatorCondition
     */
    public static function lessThan($fieldName, $value)
    {
        return SimpleOperatorCondition::lessThan($fieldName, $value);
    }

    /**
     * @param string $fieldName
     * @param mixed $value
     * @return SimpleOperatorCondition
     */
    public static function lessThanOrEqual($fieldName, $value)
    {
        return SimpleOperatorCondition::lessThanOrEqual($fieldName, $value);
    }

    /**
     * @param string $field
     * @param string $phrase
     * @return PhraseCondition
     */
    public static function startsWithPhrase($field, $phrase)
    {
        return PhraseCondition::startsWith($field, $phrase);
    }

    /**
     * @param string $field
     * @param string $phrase
     * @return PhraseCondition
     */
    public static function containsPhrase($field, $phrase)
    {
        return PhraseCondition::contains($field, $phrase);
    }

    /**
     * @param string $field
     * @param string $phrase
     * @return PhraseCondition
     */
    public static function endsWithPhrase($field, $phrase)
    {
        return PhraseCondition::endsWith($field, $phrase);
    }

    /**
     * @param string $field
     * @param mixed $from
     * @param mixed $to
     * @return BetweenCondition
     */
    public static function between($field, $from, $to)
    {
        return new BetweenCondition($field, $from, $to);
    }

    /**
     * @param string $field
     * @return DefinedCondition
     */
    public static function defined($field)
    {
        return DefinedCondition::defined($field);
    }

    /**
     * @param string $field
     * @return DefinedCondition
     */
    public static function notDefined($field)
    {
        return DefinedCondition::notDefined($field);
    }
}