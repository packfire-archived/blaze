<?php

namespace Packfire\Blaze\Meta\Index;

use Packfire\Blaze\Meta\Attribute\AttributeCollection;
use Packfire\Blaze\Meta\Attribute\Attribute;

class PrimaryKeyTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $index = new PrimaryKey();
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Attribute\\AttributeCollection', $index->attributes());
        $this->assertEquals('pk_', $index->name());
    }

    public function testConstructWithCollection()
    {
        $attributes = new AttributeCollection();
        $attributes->add(new Attribute('keyId', 'KeyId', 'INT NOT NULL'));

        $index = new PrimaryKey($attributes);
        $this->assertEquals($attributes, $index->attributes());
        $this->assertEquals('pk_keyid', $index->name());
    }
}
