<?php

namespace QueryObject\Tests\Traits;

use QueryObject\Condition\IdentifierCondition;
use QueryObject\Tests\QueryBridge;

class IdentifierQueryTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QueryBridge
     */
    private $object;

    const ID = 'some-id';

    protected function setUp()
    {
        $this->object = new QueryBridge();
    }

    public function testSettingId()
    {
        $this->object->byId(self::ID);

        $this->assertContains(new IdentifierCondition(self::ID), $this->object->getConditions(), '', false, false);
    }

    public function gettingId()
    {
        $this->object->byId(self::ID);
        $this->assertSame(self::ID, $this->object->getId());
    }
}