<?php

namespace Packfire\Blaze\Utility;

use Packfire\Blaze\Meta\Index\PrimaryKey;
use Packfire\Blaze\Meta\Attribute;

class IndexUtilityTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $index = new PrimaryKey();
        $index->attributes()->add(new Attribute('test1', 'test1', 'TEXT'));
        $index->attributes()->add(new Attribute('test2', 'test2', 'int'));

        $result = IndexUtility::name($index);
        $this->assertEquals('idx_test1_test2', $result);
    }
    
    public function testNameCustom()
    {
        $index = new PrimaryKey();
        $index->attributes()->add(new Attribute('test1', 't@st1', 'TEXT'));
        $index->attributes()->add(new Attribute('test2', 't@st2', 'int'));

        $result = IndexUtility::name($index, 'FK_');
        $this->assertEquals('FK_t_st1_t_st2', $result);
    }
}
