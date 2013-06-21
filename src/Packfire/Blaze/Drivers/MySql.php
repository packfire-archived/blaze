<?php

namespace Packfire\Blaze\Drivers;

class MySql implements DriverInterface
{
    protected $database;

    protected $engine;

    protected $charset;

    private static $options = array(
        'database',
        'engine',
        'charset'
    );

    public function __construct($options = array())
    {
        foreach (self::$options as $key) {
            if (isset($options[$key])) {
                $this->$key = $options[$key];
            }
        }
    }

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
            $script .= "------\n";
            $script .= "-- Creating Database\n";
            $script .= "------\n";
            $script .= 'CREATE DATABASE IF NOT EXISTS `' . $this->database . '`';
            if ($this->charset) {
                $script .= ' DEFAULT CHARSET=' . $this->charset;
            }
            $script .= ";\n";
            $script .= 'USE `' . $this->database . '`;' . "\n\n";
        }

        foreach ($entities as $entity) {
            $script .= "------\n";
            $script .= '-- Generating for entity ' . $entity->className() . "\n";
            $script .= "------\n";
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

    protected function typeChecker($type)
    {
        switch (strtolower($type)) {
            case 'string':
                return 'TEXT';
                break;
        }
        return $type;
    }
}
