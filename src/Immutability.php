<?php

declare(strict_types=1);

namespace TinyBlocks\Immutable;

use TinyBlocks\Immutable\Internal\Exceptions\CollectionCannotBeChanged;
use TinyBlocks\Immutable\Internal\Exceptions\CollectionCannotBeDeactivated;
use TinyBlocks\Immutable\Internal\Exceptions\PropertyCannotBeChanged;
use TinyBlocks\Immutable\Internal\Exceptions\PropertyCannotBeDeactivated;

trait Immutability
{
    public function __set(mixed $key, mixed $value): void
    {
        throw new PropertyCannotBeChanged(key: $key, value: $value, class: get_called_class());
    }

    public function __unset(mixed $key): void
    {
        throw new PropertyCannotBeDeactivated(key: $key, class: get_called_class());
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new CollectionCannotBeChanged(offset: $offset, value: $value, class: get_called_class());
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new CollectionCannotBeDeactivated(offset: $offset, class: get_called_class());
    }
}
