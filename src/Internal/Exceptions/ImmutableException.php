<?php

declare(strict_types=1);

namespace TinyBlocks\Immutable\Internal\Exceptions;

use RuntimeException;

class ImmutableException extends RuntimeException
{
    protected function withMessage(string $template, mixed ...$values): string
    {
        $formattedValues = array_map(static function (mixed $value) {
            return is_scalar($value) ? $value : var_export($value, true);
        }, $values);

        return sprintf($template, ...$formattedValues);
    }
}
