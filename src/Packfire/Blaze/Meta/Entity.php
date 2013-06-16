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
            $propertyBlock = new DocBlock($property);
            $name = $property->getName();
            $attribute = null;
            $type = null;
            $attributeTags = $propertyBlock->getTagsByName('attribute');
            if ($attributeTags) {
                $attribute = $attributeTags[0]->getContent();
            }
            $variableTags = $propertyBlock->getTagsByName('var');
            if ($variableTags) {
                $type = $variableTags[0]->getContent();
            }
            if ($attribute && $type) {
                $this->attributes[] = new Attribute($name, $attribute, $type);
            }
        }
    }

    /**
     * Gets all the properties of a class recursively.
     * @param string|\ReflectionClass $class The class or the name of it.
     * @return \ReflectionProperty[] Returns an array of property names in the class.
     * @since 1.0.0
     */
    protected static function getClassProperties($class)
    {
        if (is_string($class)) {
            $class = new \ReflectionClass($class);
        }
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
