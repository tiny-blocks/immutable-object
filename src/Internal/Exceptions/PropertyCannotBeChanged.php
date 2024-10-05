<?php

declare(strict_types=1);

namespace TinyBlocks\Immutable\Internal\Exceptions;

final class PropertyCannotBeChanged extends ImmutableException
{
    public function __construct(string $key, mixed $value, string $class)
    {
        $template = 'Property <%s> with value <%s> cannot be changed in class <%s>.';
        parent::__construct(message: $this->withMessage($template, $key, $value, $class));
    }
}
