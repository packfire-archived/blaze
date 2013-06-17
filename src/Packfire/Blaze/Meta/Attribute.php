<?php

namespace Packfire\Blaze\Meta;

use phpDocumentor\Reflection\DocBlock;

class Attribute
{
    protected $property;

    protected $attribute;

    protected $type;

    public function __construct($property, $attribute, $type)
    {
        $this->property = $property;
        $this->attribute = $attribute;
        $this->type = $type;
    }

    public function property()
    {
        return $this->property;
    }

    public function attribute()
    {
        return $this->attribute;
    }

    public function type()
    {
        return $this->type;
    }

    public static function load(\ReflectionProperty $property)
    {
        $propertyBlock = new DocBlock($property);

        $name = $property->getName();
        $attribute = null;
        $type = null;

        $result = null;
        $attributeTags = $propertyBlock->getTagsByName('attribute');
        if ($attributeTags) {
            // attribute tag is very important. it signifies the glory
            // that an entity holds.
            $attribute = $attributeTags[0]->getContent();

            // if annotation is empty, we fill it with the property name
            if (!$attribute) {
                $attribute = $name;
            }

            $type = self::fetchTag($propertyBlock, 'type');
            if (!$type) {
                $type = self::fetchTag($propertyBlock, 'var');
            }
            if ($type) {
                $result = new Attribute($name, $attribute, $type);
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
