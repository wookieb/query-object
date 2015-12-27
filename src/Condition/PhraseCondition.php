<?php

namespace QueryObject\Condition;

class PhraseCondition implements ConditionInterface
{
    const STARTS_WITH = 'starts-with';
    const ENDS_WITH = 'ends-with';
    const CONTAINS = 'contains';
    /**
     * @var string
     */
    private $field;
    /**
     * @var string
     */
    private $phrase;
    /**
     * @var string
     */
    private $mode;

    /**
     * PhraseCondition constructor.
     */
    private function __construct($field, $phrase, $mode)
    {
        ConditionsUtil::assertFieldName($field);
        $this->field = $field;
        $this->phrase = $phrase;
        $this->mode = $mode;
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
    public function getPhrase()
    {
        return $this->phrase;
    }

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    public function isStartWith()
    {
        return $this->mode === self::STARTS_WITH;
    }

    public function isEndWith()
    {
        return $this->mode === self::ENDS_WITH;
    }

    public function isContains()
    {
        return $this->mode === self::CONTAINS;
    }

    /**
     * @param string $fieldName
     * @param string $phrase
     * @return PhraseCondition
     */
    public static function contains($fieldName, $phrase)
    {
        return new self($fieldName, $phrase, self::CONTAINS);
    }

    /**
     * @param string $fieldName
     * @param string $phrase
     * @return PhraseCondition
     */
    public static function startsWith($fieldName, $phrase)
    {
        return new self($fieldName, $phrase, self::STARTS_WITH);
    }

    /**
     * @param string $fieldName
     * @param string $phrase
     * @return PhraseCondition
     */
    public static function endsWith($fieldName, $phrase)
    {
        return new self($fieldName, $phrase, self::ENDS_WITH);
    }
}