<?php

namespace Packfire\Blaze\Drivers\MySql;

use Packfire\Blaze\Drivers\DriverInterface;

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

        $builder = new EntityBuilder($tableOptions);
        foreach ($entities as $entity) {
            $script .= $builder->build($entity);
        }
        return $script;
    }
}
