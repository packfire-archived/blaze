<?php

namespace Packfire\Blaze\Meta;

interface CollectionInterface implements \IteratorAggregator, \Countable, \ArrayAccess
{
    public function add($value);

    public function get($index);
}
