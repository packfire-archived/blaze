<?php

namespace Packfire\Blaze\Drivers\MySql;

use Packfire\Blaze\Drivers\AttributeBuilderInterface;
use Packfire\Blaze\Meta\Attribute\AttributeInterface;

class AttributeBuilder implements AttributeBuilderInterface
{
    public function build(AttributeInterface $attribute)
    {
        $type = self::typeChecker($attribute->type());
        return '  `' . $attribute->name() . '` ' . $type;
    }

    protected static function typeChecker($type)
    {
        switch (strtolower($type)) {
            case 'string':
                return 'TEXT';
                break;
        }
        return $type;
    }
}
