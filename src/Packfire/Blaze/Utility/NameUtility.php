<?php

namespace Packfire\Blaze\Utility;

class NameUtility
{
    const PREGEX = '/^(((?<namespace>.+?)(\:\:\$|\$|$))(?<var>.*?))$/';

    public static function parse($name)
    {
        $matches = array();
        $result = preg_match(self::PREGEX, $name, $matches);
        if ($result) {
            return array(
                'namespace' => $matches['namespace'],
                'variable' => $matches['var']
            );
        }
        return null;
    }
}
