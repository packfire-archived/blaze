<?php

namespace Packfire\Blaze\Drivers\MySql;

use Packfire\Blaze\Meta\Index\PrimaryKey;
use Packfire\Blaze\Meta\Index\Reference;
use Packfire\Blaze\Meta\Index\ForeignKey;
use Packfire\Blaze\Meta\Index\Key;
use Packfire\Blaze\Meta\Index\Unique;

use Packfire\Blaze\Meta\Entity\Entity;
use Packfire\Blaze\Meta\Attribute\Attribute;
use Packfire\Blaze\Meta\Attribute\AttributeCollection;

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

        $collection = new AttributeCollection();
        $collection->add(new Attribute('userId', 'UserId', 'INT NOT NULL AUTOINCREMENT'));
        $reference = new Reference('users', $collection);
        
        $index = new ForeignKey($reference);
        $index->attributes()->add(new Attribute('userId', 'UserId', 'INT NOT NULL AUTOINCREMENT'));

        $builder = new IndexBuilder($entity);

        $expectation = <<<EOT
ALTER TABLE `tests` ADD CONSTRAINT `fk_userid` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);
EOT;
        $this->assertEquals($expectation, $builder->build($index));
    }

    public function testBuildKey()
    {
        $entity = new Entity('\\Test', 'tests');
        $index = new Key();
        $index->attributes()->add(new Attribute('testId', 'TestId', 'INT NOT NULL AUTOINCREMENT'));

        $builder = new IndexBuilder($entity);

        $expectation = <<<EOT
ALTER TABLE `tests` ADD CONSTRAINT `idx_testid` INDEX (`TestId`);
EOT;
        $this->assertEquals($expectation, $builder->build($index));
    }

    public function testBuildUnique()
    {
        $entity = new Entity('\\Test', 'tests');
        $index = new Unique();
        $index->attributes()->add(new Attribute('testId', 'TestId', 'INT NOT NULL AUTOINCREMENT'));

        $builder = new IndexBuilder($entity);

        $expectation = <<<EOT
ALTER TABLE `tests` ADD CONSTRAINT `uniq_testid` UNIQUE (`TestId`);
EOT;
        $this->assertEquals($expectation, $builder->build($index));
    }
}
