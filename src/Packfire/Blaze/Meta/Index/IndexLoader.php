<?php

namespace Packfire\Blaze\Meta\Index;

use phpDocumentor\Reflection\DocBlock\Tag;
use phpDocumentor\Reflection\DocBlock;
use Packfire\Blaze\Meta\Attribute\AttributeCollection;

class IndexLoader
{
    protected static $registry = array(
        'key' => 'Packfire\\Blaze\\Meta\\Index\\Key',
        'pk' => 'Packfire\\Blaze\\Meta\\Index\\PrimaryKey',
        'primary' => 'Packfire\\Blaze\\Meta\\Index\\PrimaryKey',
        'unique' => 'Packfire\\Blaze\\Meta\\Index\\Unique'
    );

    public static function load($result, AttributeCollection $attributes)
    {
        $sortedList = array();
        foreach ($result as $data) {
            $sortedList[$data[1]] = array($data[0], $data[2]);
        }

        $collection = new IndexCollection();
        foreach ($sortedList as $name => $data) {
            list($type, $attribs) = $data;
            if (isset(self::$registry[$type])) {
                $class = self::$registry[$type];
                $indexAttributes = new AttributeCollection();
                foreach ($attribs as $reference) {
                    $attribute = $attributes->get($reference);
                    if ($attribute) {
                        $indexAttributes->add($attribute);
                    }
                }
                $index = new $class($indexAttributes);
                $collection->add($index);
            }
        }
        return $collection;
    }

    public static function explore(DocBlock $classBlock)
    {
        $result = array();
        $indexes = $classBlock->getTagsByName('index');
        if ($indexes) {
            foreach ($indexes as $index) {
                $result[] = self::parseTagContent($index);
            }
        }
        return $result;
    }

    protected static function parseTagContent(Tag $tag)
    {
        $attributes = array();

        $parsed = preg_split('/[\s,|]+/', $tag->getContent());
        $type = array_shift($parsed);

        $name = array_shift($parsed);
        if ($name && substr($name, 0, 1) == '$') {
            $attributes[] = substr($name, 1);
            $name = null;
        }

        foreach ($parsed as $attribute) {
            if (substr($attribute, 0, 1) == '$') {
                $attributes[] = substr($attribute, 1);
            }
        }
        return array($type, $name, $attributes);
    }
}
