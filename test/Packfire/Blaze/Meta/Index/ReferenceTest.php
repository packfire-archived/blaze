<?php

namespace Packfire\Blaze\Meta\Index;

use Packfire\Blaze\Meta\AttributeCollection;

class ReferenceTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $index = new Reference('test', new AttributeCollection());
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\AttributeCollection', $index->attributes());
        $this->assertEquals('test', $index->name());
    }
}
