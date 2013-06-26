<?php

namespace Packfire\Blaze\Meta\Entity;

interface EntityInterface
{
    public function className();

    public function name();

    public function attributes();

    public function indexes();
}
