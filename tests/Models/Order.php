<?php

declare(strict_types=1);

namespace TinyBlocks\Immutable\Models;

use TinyBlocks\Immutable\Immutability;
use TinyBlocks\Immutable\Immutable;

final class Order implements Immutable
{
    use Immutability;

    public function __construct(public int $id, public Products $products)
    {
    }
}
