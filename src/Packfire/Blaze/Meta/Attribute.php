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
        $attributeTags = $propertyBlock->getTagsByName('attribute');
        if ($attributeTags) {
            $attribute = $attributeTags[0]->getContent();
        }
        $variableTags = $propertyBlock->getTagsByName('var');
        if ($variableTags) {
            $type = $variableTags[0]->getContent();
        }
        if ($attribute && $type) {
            return new Attribute($name, $attribute, $type);
        }
        return null;
    }
}
