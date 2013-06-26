<?php

namespace Packfire\Blaze\Utility;

use Packfire\Blaze\Meta\Index\IndexInterface;
use Packfire\Blaze\Meta\Attribute\AttributeCollection;

class IndexUtility
{
    public static function name(IndexInterface $index, $prefix = 'idx_')
    {
        $listing = AttributeUtility::listing($index->attributes(), '_', '');
        $result = preg_replace(array('/[^\\pL\d]+/u', '/[^_\w]+/'), array('_', ''), $listing);
        return $prefix . strtolower($result);
    }
}
