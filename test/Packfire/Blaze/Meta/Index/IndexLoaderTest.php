<?php

namespace Packfire\Blaze\Meta\Index;

use Packfire\Blaze\Meta\Attribute\AttributeCollection;
use Packfire\Blaze\Meta\Attribute\Attribute;
use phpDocumentor\Reflection\DocBlock;

class IndexLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testExplore()
    {
        $class = new \ReflectionClass('Packfire\\Blaze\\Fixture\\Dummy');
        $classBlock = new DocBlock($class);
        $result = IndexLoader::explore($classBlock);
        $expected = array(
            array(
                'unique',
                null,
                array(
                    'name'
                )
            )
        );
        $this->assertEquals($expected, $result);
    }

    public function testLoad()
    {
        $class = new \ReflectionClass('Packfire\\Blaze\\Fixture\\Dummy');
        $classBlock = new DocBlock($class);
        $result = IndexLoader::explore($classBlock);
        
        $attributes = new AttributeCollection();
        $attributes->add(new Attribute('name', 'name', 'TEXT'));

        $indexes = IndexLoader::load($result, $attributes);
        $index = $indexes[0];
        $this->assertInstanceOf('Packfire\\Blaze\\Meta\\Index\\Unique', $index);
        $this->assertEquals($attributes['name'], $index->attributes()->get('name'));
    }
}