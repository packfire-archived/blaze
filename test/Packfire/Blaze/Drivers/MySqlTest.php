<?php

namespace Packfire\Blaze\Drivers;

use Packfire\Blaze\Meta\Entity;

class MySqlTest extends \PHPUnit_Framework_TestCase
{
    const DUMMY = 'Packfire\\Blaze\\Fixture\\Dummy';
    const BIGGER_DUMMY = 'Packfire\\Blaze\\Fixture\\BiggerDummy';

    public function testGenerate()
    {
        $driver = new MySql();
        $entities = array(
            new Entity(self::BIGGER_DUMMY)
        );
        
        $proper = <<<EOT
-- Generating for entity Packfire\Blaze\Fixture\BiggerDummy
CREATE TABLE IF NOT EXISTS`dummies` (
  `Name` TEXT,
  `Age` TINYINT,
  `height` double
) ;


EOT;
        $this->assertEquals($proper, $driver->generate($entities));
    }
}
