<?php

namespace Packfire\Blaze\Drivers\MySql;

use Packfire\Blaze\Meta\Entity\EntityLoader;

class EntityBuilderTest extends \PHPUnit_Framework_TestCase
{
    const DUMMY = 'Packfire\\Blaze\\Fixture\\BiggerDummy';

    public function testBuild()
    {
        $entity = EntityLoader::load(new \ReflectionClass(self::DUMMY));
        $builder = new EntityBuilder('ENGINE=INNODB DEFAULT CHARSET=utf8 ');

        $expectation = <<<EOT
------
-- Generating entity for class `Packfire\Blaze\Fixture\BiggerDummy`
------
CREATE TABLE IF NOT EXISTS `dummies` (
  `Name` TEXT,
  `Age` TINYINT,
  `height` double
) ENGINE=INNODB DEFAULT CHARSET=utf8 ;


EOT;
        $this->assertEquals($expectation, $builder->build($entity));
    }
}
