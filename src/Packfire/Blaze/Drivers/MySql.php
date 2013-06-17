<?php

namespace Packfire\Blaze\Drivers;

class MySql implements DriverInterface
{
    protected $database;

    protected $engine;

    protected $charset;

    public function generate($entities)
    {
        $script = '';
        $tableOptions = '';
        if ($this->engine) {
            $tableOptions .= 'ENGINE=' . $this->engine . ' ';
        }
        if ($this->charset) {
            $tableOptions .= 'DEFAULT CHARSET=' . $this->charset . ' ';
        }

        if ($this->database) {
            $script .= 'CREATE DATABASE IF NOT EXISTS `' . $this->database . '`';
            if ($this->charset) {
                $script .= ' DEFAULT CHARSET=' . $this->charset . ' ';
            }
            $script .= ";\n";
            $script .= 'USE `' . $this->database . '`;';
        }

        foreach ($entities as $entity) {
            $entity->parse();
            $script .= '-- Generating for entity ' . $entity->className() . "\n";
            $script .= 'CREATE TABLE IF NOT EXISTS`' . $entity->name() . '` (' . "\n";
            $script .= $this->attributesBuilder($entity);
            $script .= ') ' . $tableOptions . ';' . "\n\n";
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
