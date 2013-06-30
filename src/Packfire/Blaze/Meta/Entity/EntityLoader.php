<?php

namespace Packfire\Blaze\Meta\Entity;

use phpDocumentor\Reflection\DocBlock;
use Packfire\Blaze\Meta\Attribute\AttributeCollection;
use Packfire\Blaze\Meta\Attribute\AttributeLoader;
use Packfire\Blaze\Meta\Index\IndexCollection;
use Packfire\Blaze\Meta\Index\IndexLoader;

class EntityLoader
{
    protected $attributes;

    protected $indexes;

    protected function __construct()
    {
        $this->attributes = new AttributeCollection();
        $this->indexes = new IndexCollection();
    }

    public static function load(\ReflectionClass $class)
    {
        $classBlock = new DocBlock($class);
        $entityTags = $classBlock->getTagsByName('entity');
        if ($entityTags) {
            $name = $entityTags[0]->getContent();

            $loader = new EntityLoader();
            $loader->handle($class);

            return new Entity($class->getName(), $name, $loader->attributes);
        }
        return null;
    }

    protected function handle(\ReflectionClass $class)
    {
        $properties = array();
        $indexes = array();
        $this->exploreClassHierarchy($class, $properties, $indexes);
        foreach ($properties as $property) {
            $attribute = AttributeLoader::load($property);
            if ($attribute) {
                $this->attributes->add($attribute);
            }
        }
    }

    protected function exploreClassHierarchy(\ReflectionClass $class, &$properties, &$indexes)
    {
        if ($parent = $class->getParentClass()) {
            // Recursively check for parent's class properties
            $this->exploreClassHierarchy($parent, $properties, $indees);
        }
        // check parent first so that you can override later in child class

        $classBlock = new DocBlock($class);
        $indices = IndexLoader::explore($classBlock);

        $props = $class->getProperties();
        foreach ($props as $property) {
            $properties[$property->getName()] = $property;
        }
    }
}
