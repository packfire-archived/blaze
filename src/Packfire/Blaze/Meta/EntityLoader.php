<?php

namespace Packfire\Blaze\Meta;

use phpDocumentor\Reflection\DocBlock;

class EntityLoader
{
    public static function load(\ReflectionClass $class)
    {
        $classBlock = new DocBlock($class);
        $entityTags = $classBlock->getTagsByName('entity');
        if ($entityTags) {
            $name = $entityTags[0]->getContent();

            $attributes = new AttributeCollection();
            $properties = self::getClassProperties($class);
            foreach ($properties as $property) {
                $attribute = AttributeLoader::load($property);
                if ($attribute) {
                    $attributes->add($attribute);
                }
            }
            return new Entity($class->getName(), $name, $attributes);
        }
        return null;
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
}
