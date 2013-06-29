<?php

namespace Packfire\Blaze\Drivers\MySql;

use Packfire\Blaze\Drivers\IndexBuilderInterface;
use Packfire\Blaze\Meta\Index\IndexInterface;
use Packfire\Blaze\Meta\Entity\EntityInterface;
use Packfire\Blaze\Utility\AttributeUtility;

class IndexBuilder implements IndexBuilderInterface
{
    protected $entity;

    public function __construct(EntityInterface $entity)
    {
        $this->entity = $entity;
    }

    public function build(IndexInterface $index)
    {
        $script = 'ALTER TABLE `' . $this->entity->name() . '` ADD CONSTRAINT `' . $index->name() . '` ';
        switch(basename(get_class($index)))
        {
            case 'PrimaryKey':
                $script .= 'PRIMARY KEY (' . AttributeUtility::listing($index->attributes()) . ')';
                break;
            case 'Key':
                $script .= 'INDEX (' . AttributeUtility::listing($index->attributes()) . ')';
                break;
            case 'ForeignKey':
                $script .= 'FOREIGN KEY (' . AttributeUtility::listing($index->attributes()) . ') REFERNCES `' . $index->reference()->name() . '` (' . AttributeUtility::listing($index->reference()->attributes()) . ')';
                break;
            case 'Unique':
                $script .= 'UNIQUE (' . AttributeUtility::listing($index->attributes()) . ')';
                break;
        }
        $script .= ';';
        return $script;
    }
}
