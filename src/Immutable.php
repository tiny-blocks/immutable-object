<?php

declare(strict_types=1);

namespace TinyBlocks\Immutable;

use TinyBlocks\Immutable\Internal\Exceptions\CollectionCannotBeChanged;
use TinyBlocks\Immutable\Internal\Exceptions\CollectionCannotBeDeactivated;
use TinyBlocks\Immutable\Internal\Exceptions\PropertyCannotBeChanged;
use TinyBlocks\Immutable\Internal\Exceptions\PropertyCannotBeDeactivated;

/**
 * Defines the behavior for ensuring that an object and its collections are immutable after initialization.
 * Any attempt to modify or unset properties or collection elements will result in an exception.
 */
interface Immutable
{
    /**
     * Prevents modification of properties after the object is initialized.
     *
     * @param mixed $key The name of the property being accessed.
     * @param mixed $value The new value that is being attempted to set.
     * @throws PropertyCannotBeChanged If an attempt is made to change a property.
     */
    public function __set(mixed $key, mixed $value): void;

    /**
     * Prevents properties from being unset after the object is initialized.
     *
     * @param mixed $key The name of the property being unset.
     * @throws PropertyCannotBeDeactivated If an attempt is made to unset a property.
     */
    public function __unset(mixed $key): void;

    /**
     * Prevents modification of collection (list) elements after the object is initialized.
     *
     * @param mixed $offset The index of the element being accessed.
     * @param mixed $value The new value that is being attempted to set at the specified index.
     * @throws CollectionCannotBeChanged If an attempt is made to modify a collection element.
     */
    public function offsetSet(mixed $offset, mixed $value): void;

    /**
     * Prevents elements from being unset in a collection (list) after the object is initialized.
     *
     * @param mixed $offset The index of the element being unset.
     * @throws CollectionCannotBeDeactivated If an attempt is made to unset a collection element.
     */
    public function offsetUnset(mixed $offset): void;
}
