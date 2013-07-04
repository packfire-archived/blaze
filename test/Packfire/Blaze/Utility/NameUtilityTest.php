<?php

namespace Packfire\Blaze\Utility;

class NameUtilityTest extends \PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $result = NameUtility::parse('Packfire\\Test');
        $this->assertEquals(array('namespace' => 'Packfire\\Test', 'variable' => null), $result);
    }

    public function testParse2()
    {
        $result = NameUtility::parse('Packfire\\Test::$name');
        $this->assertEquals(array('namespace' => 'Packfire\\Test', 'variable' => 'name'), $result);
    }

    public function testParseFail()
    {
        $result = NameUtility::parse(null);
        $this->assertNull($result);
    }
}
