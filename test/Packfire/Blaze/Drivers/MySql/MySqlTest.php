<?php

namespace Packfire\Blaze\Drivers\MySql;

use Packfire\Blaze\Meta\Entity\EntityLoader;

class MySqlTest extends \PHPUnit_Framework_TestCase
{
    const DUMMY = 'Packfire\\Blaze\\Fixture\\BiggerDummy';

    public function testGenerate()
    {
        $driver = new MySql();
        $entities = array(
            EntityLoader::load(new \ReflectionClass(self::DUMMY))
        );
        
        $proper = <<<EOT
------
-- Generating entity for class `Packfire\Blaze\Fixture\BiggerDummy`
------
CREATE TABLE IF NOT EXISTS `dummies` (
  `Name` TEXT,
  `dummyId` integer,
  `foreignId` integer,
  `Age` TINYINT,
  `height` double
) ;


EOT;
        $this->assertEquals($proper, $driver->generate($entities));
    }

    public function testGenerateWithParams()
    {
        $driver = new MySql(
            array(
                'engine' => 'INNODB',
                'charset' => 'utf8'
            )
        );
        $entities = array(
            EntityLoader::load(new \ReflectionClass(self::DUMMY))
        );
        
        $proper = <<<EOT
------
-- Generating entity for class `Packfire\Blaze\Fixture\BiggerDummy`
------
CREATE TABLE IF NOT EXISTS `dummies` (
  `Name` TEXT,
  `dummyId` integer,
  `foreignId` integer,
  `Age` TINYINT,
  `height` double
) ENGINE=INNODB DEFAULT CHARSET=utf8 ;


EOT;
        $this->assertEquals($proper, $driver->generate($entities));
    }

    public function testGenerateWithDatabase()
    {
        $driver = new MySql(
            array(
                'engine' => 'INNODB',
                'charset' => 'utf8',
                'database' => 'test'
            )
        );
        $entities = array(
            EntityLoader::load(new \ReflectionClass(self::DUMMY))
        );
        
        $proper = <<<EOT
------
-- Creating Database
------
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARSET=utf8;
USE `test`;

------
-- Generating entity for class `Packfire\Blaze\Fixture\BiggerDummy`
------
CREATE TABLE IF NOT EXISTS `dummies` (
  `Name` TEXT,
  `dummyId` integer,
  `foreignId` integer,
  `Age` TINYINT,
  `height` double
) ENGINE=INNODB DEFAULT CHARSET=utf8 ;


EOT;
        $this->assertEquals($proper, $driver->generate($entities));
    }
}
