<?php

namespace QueryObject\Translator;

use QueryObject\Query;

interface QueryTranslatorInterface
{
    /**
     * Transform query to any format appropriate for implementation
     * @param Query $query
     * @return mixed
     */
    public function translate(Query $query);
}