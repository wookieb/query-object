<?php

namespace QueryObject;

use QueryObject\Traits\LimitQueryTrait;
use QueryObject\Traits\OffsetQueryTrait;
use QueryObject\Traits\SortingQueryTrait;

class StandardQuery extends Query
{
    use LimitQueryTrait, OffsetQueryTrait, SortingQueryTrait;
}