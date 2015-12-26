<?php

namespace QueryObject;

use QueryObject\Traits\LimitQueryTrait;
use QueryObject\Traits\OffsetQueryTrait;
use QueryObject\Traits\SortingQueryTrait;

class StandardQuery
{
    use LimitQueryTrait, OffsetQueryTrait, SortingQueryTrait;
}