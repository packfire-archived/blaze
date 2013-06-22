<?php

namespace Packfire\Blaze\Meta;

interface CollectionInterface extends \IteratorAggregate, \Countable, \ArrayAccess
{
    public function add($value);

    public function get($index);
}
