<?php

namespace Packfire\Blaze\Meta\Index;

use Packfire\Blaze\Meta\Attribute\AttributeCollection;
use Packfire\Blaze\Meta\Attribute\Attribute;

class UniqueTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $index = new Unique();
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Attribute\\AttributeCollection', $index->attributes());
        $this->assertEquals('uniq_', $index->name());
    }

    public function testConstructWithCollection()
    {
        $attributes = new AttributeCollection();
        $attributes->add(new Attribute('keyId', 'KeyId', 'INT NOT NULL'));

        $index = new Unique($attributes);
        $this->assertEquals($attributes, $index->attributes());
        $this->assertEquals('uniq_keyid', $index->name());
    }
}
