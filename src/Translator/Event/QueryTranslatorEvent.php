<?php

namespace QueryObject\Translator\Event;

use QueryObject\Query;
use Symfony\Component\EventDispatcher\Event;

class QueryTranslatorEvent extends Event
{
    const TRANSLATE_QUERY = 'translate:query';
    /**
     * @var Query
     */
    private $query;

    /**
     * @var bool
     */
    private $handled = false;

    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    /**
     * @return Query
     */
    public function getQuery()
    {
        return $this->query;
    }

    public function markAsHandled()
    {
        $this->handled = true;
    }

    public function isHandled()
    {
        return $this->handled;
    }
}