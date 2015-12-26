<?php

namespace QueryObject\Condition;


use Assert\Assertion;

class PhraseCondition
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
    public function __construct($field, $phrase, $mode = self::CONTAINS)
    {
        Assertion::notBlank($field, null, 'column');
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

    public function isStartWithMode()
    {
        return $this->mode === self::STARTS_WITH;
    }

    public function isEndWithMode()
    {
        return $this->mode === self::ENDS_WITH;
    }

    public function isContainsMOde()
    {
        return $this->mode === self::CONTAINS;
    }
}