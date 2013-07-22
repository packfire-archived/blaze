<?php

namespace Packfire\Blaze\Meta\Attribute;

use phpDocumentor\Reflection\DocBlock;

class IndexLoader
{
    protected $attribute;

    protected $docBlock;

    public function __construct(Attribute $attribute, DocBlock $docBlock)
    {
        $this->attribute = $attribute;
        $this->docBlock = $docBlock;
    }

    public function loadIndex()
    {
        $tags = $this->docBlock->getTagsByName('id');
        if ($tags) {
            $tag = $tags[0];
            $parsed = preg_split('/\s+/', $tag->getContent());
            $attributes = new AttributeCollection();
            $attributes->add($this->attribute);
            if (count($parsed) > 1) {
                list($class, $property) = $parsed;
                $refAttributes = new AttributeCollection();
                $refAttributes->add(new Attribute($property, $property, ''));
                $reference = new Reference($class, $refAttributes);
                $index = new ForeignKey($reference, $attributes);
            } else {
                $index = new PrimaryKey($attributes);
            }
            return $index;
        }
    }
}
