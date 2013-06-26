<?php

namespace Packfire\Blaze\Meta;

use phpDocumentor\Reflection\DocBlock;

class AttributeLoader
{
    public static function load(\ReflectionProperty $property)
    {
        $propertyBlock = new DocBlock($property);

        $propertyName = $property->getName();
        $attributeName = null;
        $type = null;

        $result = null;
        $attributeTags = $propertyBlock->getTagsByName('attribute');
        if ($attributeTags) {
            // attribute tag is very important. it signifies the glory
            // that an entity holds.
            $attributeName = $attributeTags[0]->getContent();

            // if annotation is empty, we fill it with the property name
            if (!$attributeName) {
                $attributeName = $propertyName;
            }

            $type = self::fetchTag($propertyBlock, 'type');
            if (!$type) {
                $type = self::fetchTag($propertyBlock, 'var');
            }
            if ($type) {
                $result = new Attribute($propertyName, $attributeName, $type);
            }
        }
        return $result;
    }

    protected static function fetchTag(DocBlock $docBlock, $name)
    {
        $result = null;
        $tags = $docBlock->getTagsByName($name);
        if ($tags) {
            $result = $tags[0]->getContent();
        }
        return $result;
    }
}
