<?php

namespace QueryObject\Tests\Condition;


use QueryObject\Condition\EqualsCondition;
use QueryObject\Condition\IdentifierCondition;
use QueryObject\Condition\PhraseCondition;

class Conditions
{
    /**
     * @param $fieldName
     * @param $value
     * @return EqualsCondition
     */
    public static function equals($fieldName, $value)
    {
        return new EqualsCondition($fieldName, $value);
    }

    public static function id($id)
    {
        return new IdentifierCondition($id);
    }

    public static function startsWithPhrase($field, $phrase)
    {
        return new PhraseCondition($field, $phrase, PhraseCondition::STARTS_WITH);
    }

    public static function containsPhrase($field, $phrase)
    {
        return new PhraseCondition($field, $phrase, PhraseCondition::CONTAINS);
    }

    public static function endsWithPhrase($field, $phrase)
    {
        return new PhraseCondition($field, $phrase, PhraseCondition::ENDS_WITH);
    }
}