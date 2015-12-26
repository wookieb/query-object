<?php

namespace QueryObject\Condition;

class Conditions
{
    /**
     * @param $fieldName
     * @param $value
     * @return SimpleOperatorCondition
     */
    public static function equals($fieldName, $value)
    {
        return SimpleOperatorCondition::equals($fieldName, $value);
    }

    /**
     * @param $fieldName
     * @param $value
     * @return SimpleOperatorCondition
     */
    public static function greaterThan($fieldName, $value)
    {
        return SimpleOperatorCondition::greaterThan($fieldName, $value);
    }

    /**
     * @param $fieldName
     * @param $value
     * @return SimpleOperatorCondition
     */
    public static function greaterThanOrEqual($fieldName, $value)
    {
        return SimpleOperatorCondition::greaterThanOrEqual($fieldName, $value);
    }

    /**
     * @param $fieldName
     * @param $value
     * @return SimpleOperatorCondition
     */
    public static function lessThan($fieldName, $value)
    {
        return SimpleOperatorCondition::lessThan($fieldName, $value);
    }

    /**
     * @param $fieldName
     * @param $value
     * @return SimpleOperatorCondition
     */
    public static function lessThanOrEqual($fieldName, $value)
    {
        return SimpleOperatorCondition::lessThanOrEqual($fieldName, $value);
    }

    /**
     * @param $field
     * @param $phrase
     * @return PhraseCondition
     */
    public static function startsWithPhrase($field, $phrase)
    {
        return PhraseCondition::startsWith($field, $phrase);
    }

    /**
     * @param $field
     * @param $phrase
     * @return PhraseCondition
     */
    public static function containsPhrase($field, $phrase)
    {
        return PhraseCondition::contains($field, $phrase);
    }

    /**
     * @param $field
     * @param $phrase
     * @return PhraseCondition
     */
    public static function endsWithPhrase($field, $phrase)
    {
        return PhraseCondition::endsWith($field, $phrase);
    }
}