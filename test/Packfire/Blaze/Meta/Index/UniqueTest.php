<?php

namespace Packfire\Blaze\Meta\Index;

class UniqueTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $index = new Unique();
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Attribute\\AttributeCollection', $index->attributes());
        $this->assertEquals('uniq_', $index->name());
    }
}
