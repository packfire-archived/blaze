<?php

namespace Packfire\Blaze\Utility;

use Packfire\Blaze\Meta\Attribute\AttributeCollection;
use Packfire\Blaze\Meta\Attribute\Attribute;

class AttributeUtilityTest extends \PHPUnit_Framework_TestCase
{
    public function testListing()
    {
        $collection = new AttributeCollection();
        $collection->add(new Attribute('test1', 'test1', 'TEXT'));
        $collection->add(new Attribute('test2', 'test2', 'int'));

        $result = AttributeUtility::listing($collection);
        $this->assertEquals('`test1`, `test2`', $result);
    }

    public function testListingCustom()
    {
        $collection = new AttributeCollection();
        $collection->add(new Attribute('test1', 'test1', 'TEXT'));
        $collection->add(new Attribute('test2', 'test2', 'int'));

        $result = AttributeUtility::listing($collection, ' | ', '"');
        $this->assertEquals('"test1" | "test2"', $result);
    }
}
