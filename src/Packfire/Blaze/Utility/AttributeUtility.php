<?php

namespace Packfire\Blaze\Utility;

use Packfire\Blaze\Meta\Attribute\AttributeCollection;

class AttributeUtility
{
    public static function listing(AttributeCollection $collection, $separator = ', ', $wrapper = '`')
    {
        $compileList = array();
        foreach ($collection as $attribute) {
            $compileList[] = $wrapper . $attribute->name() . $wrapper;
        }
        return implode($compileList, $separator);
    }
}
