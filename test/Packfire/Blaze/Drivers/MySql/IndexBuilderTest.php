<?php

namespace Packfire\Blaze\Drivers\MySql;

use Packfire\Blaze\Meta\Index\PrimaryKey;
use Packfire\Blaze\Meta\Index\Reference;
use Packfire\Blaze\Meta\Index\ForeignKey;

use Packfire\Blaze\Meta\Entity\Entity;
use Packfire\Blaze\Meta\Attribute\Attribute;

class IndexBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildPrimaryKey()
    {
        $entity = new Entity('\\Test', 'tests');
        $index = new PrimaryKey();
        $index->attributes()->add(new Attribute('testId', 'TestId', 'INT NOT NULL AUTOINCREMENT'));

        $builder = new IndexBuilder($entity);

        $expectation = <<<EOT
ALTER TABLE `tests` ADD CONSTRAINT `pk_testid` PRIMARY KEY (`TestId`);
EOT;
        $this->assertEquals($expectation, $builder->build($index));
    }

    public function testBuildForeignKey()
    {
        $entity = new Entity('\\Test', 'tests');

        $reference = new Reference('users');
        $reference->attributes()->add(new Attribute('userId', 'UserId', 'INT NOT NULL AUTOINCREMENT'));
        
        $index = new ForeignKey($reference);
        $index->attributes()->add(new Attribute('userId', 'UserId', 'INT NOT NULL AUTOINCREMENT'));

        $builder = new IndexBuilder($entity);

        $expectation = <<<EOT
ALTER TABLE `tests` ADD CONSTRAINT `fk_userid` FOREIGN KEY (`UserId`) REFERENCE `users` (`UserId`);
EOT;
        $this->assertEquals($expectation, $builder->build($index));
    }
}
