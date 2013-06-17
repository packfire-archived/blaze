<?php

namespace Packfire\Blaze\Drivers;

class MySql implements DriverInterface
{
    public function generate($entities)
    {
        $script = '';
        foreach ($entities as $entity) {
            $entity->parse();
            $script .= '-- Generating for entity ' . $entity->className() . "\n";
            $script .= 'CREATE TABLE IF NOT EXISTS`' . $entity->name() . '` (' . "\n";
            $script .= $this->attributesBuilder($entity);
            $script .= ');' . "\n\n";
        }
        return $script;
    }

    protected function attributesBuilder($entity)
    {
        $attributes = array();
        foreach ($entity->attributes() as $attribute) {
            $type = $this->typeChecker($attribute->type());
            $attributes[] = '  `' . $attribute->name() . '` ' . $type;
        }
        return implode(",\n", $attributes) . "\n";
    }

    protected function typeChecker($type){
        switch(strtolower($type)){
            case 'string':
                return 'TEXT';
                break;
        }
        return $type;
    }
}
