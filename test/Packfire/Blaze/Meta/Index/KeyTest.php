<?php

namespace Packfire\Blaze\Meta\Index;

class KeyTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $index = new Key();
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\AttributeCollection', $index->attributes());
        $this->assertEquals('idx_', $index->name());
    }
}
