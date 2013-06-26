<?php

namespace Packfire\Blaze\Drivers\MySql;

use Packfire\Blaze\Drivers\EntityBuilderInterface;
use Packfire\Blaze\Meta\Entity\EntityInterface;

class EntityBuilder implements EntityBuilderInterface
{
    protected $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    public function build(EntityInterface $entity)
    {
        $script = '';
        $script .= "------\n";
        $script .= '-- Generating entity for class `' . $entity->className() . "`\n";
        $script .= "------\n";
        $script .= 'CREATE TABLE IF NOT EXISTS `' . $entity->name() . '` (' . "\n";
        $script .= self::attributesBuilder($entity);
        $script .= ') ' . $this->options . ';' . "\n\n";
        return $script;
    }

    protected static function attributesBuilder($entity)
    {
        $builder = new AttributeBuilder();
        $attributes = array();
        foreach ($entity->attributes() as $attribute) {
            $attributes[] = $builder->build($attribute);
        }
        return implode(",\n", $attributes) . "\n";
    }
}
