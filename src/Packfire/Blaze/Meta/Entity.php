<?php

namespace Packfire\Blaze\Meta;

use phpDocumentor\Reflection\DocBlock;

class Entity
{
    protected $name;

    protected $entity;

    protected $attributes;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function parse()
    {
        $class = new \ReflectionClass($this->name);
        $classBlock = new DocBlock($class);
        $entityTags = $classBlock->getTagsByName('entity');
        if ($entityTags) {
            $this->entity = $entityTags[0]->getContent();
        }

        $this->attributes = array();
        $properties = self::getClassProperties($class);
        foreach ($properties as $property) {
            $attribute = Attribute::load($property);
            if ($attribute) {
                $this->attributes[] = $attribute;
            }
        }
    }

    /**
     * Gets all the properties of a class recursively.
     * @param \ReflectionClass $class The class or the name of it.
     * @return \ReflectionProperty[] Returns an array of property names in the class.
     * @since 1.0.0
     */
    protected static function getClassProperties(\ReflectionClass $class)
    {
        $properties = $class->getProperties();
        $result = array();
        foreach ($properties as $property) {
             $result[$property->getName()] = $property;
        }
        if ($parent = $class->getParentClass()) {
            // Recursively check for parent's class properties
            $result = array_merge(self::getClassProperties($parent), $result);
        }
        return $result;
    }

    public function name()
    {
        return $this->name;
    }

    public function entity()
    {
        return $this->entity;
    }

    public function attributes()
    {
        return $this->attributes;
    }
}
