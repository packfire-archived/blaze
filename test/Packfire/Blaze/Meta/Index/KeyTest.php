<?php

namespace Packfire\Blaze\Meta\Index;

use Packfire\Blaze\Meta\Attribute\AttributeCollection;
use Packfire\Blaze\Meta\Attribute\Attribute;

class KeyTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $index = new Key();
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Attribute\\AttributeCollection', $index->attributes());
        $this->assertEquals('idx_', $index->name());
    }

    public function testConstructWithCollection()
    {
        $attributes = new AttributeCollection();
        $attributes->add(new Attribute('keyId', 'KeyId', 'INT NOT NULL'));

        $index = new Key($attributes);
        $this->assertEquals($attributes, $index->attributes());
        $this->assertEquals('idx_keyid', $index->name());
    }
}
