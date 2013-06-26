<?php

namespace Packfire\Blaze\Meta\Index;

class PrimaryKeyTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $index = new PrimaryKey();
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Attribute\\AttributeCollection', $index->attributes());
        $this->assertEquals('pk_', $index->name());
    }
}
