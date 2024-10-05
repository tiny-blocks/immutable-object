<?php

declare(strict_types=1);

namespace TinyBlocks\Immutable\Models;

use ArrayIterator;
use TinyBlocks\Immutable\Immutability;
use TinyBlocks\Immutable\Immutable;

final class Products extends ArrayIterator implements Immutable
{
    use Immutability;
}
