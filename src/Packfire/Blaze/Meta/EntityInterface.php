<?php

namespace Packfire\Blaze\Meta;

interface EntityInterface
{
    public function className();

    public function name();

    public function attributes();

    public function indexes();
}
