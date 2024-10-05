<?php

declare(strict_types=1);

namespace TinyBlocks\Immutable\Models;

use TinyBlocks\Immutable\Immutability;
use TinyBlocks\Immutable\Immutable;

final class Amount implements Immutable
{
    use Immutability;

    public function __construct(public float $value, public string $currency)
    {
    }
}
