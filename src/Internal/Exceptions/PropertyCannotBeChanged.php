<?php

declare(strict_types=1);

namespace TinyBlocks\Immutable\Internal\Exceptions;

final class PropertyCannotBeChanged extends ImmutableException
{
    public function __construct(
        private readonly string $key,
        private readonly mixed $value,
        private readonly string $class
    ) {
        $template = 'Property <%s> with value <%s> cannot be changed in class <%s>.';

        parent::__construct(message: $this->withMessage($template, $this->key, $this->value, $this->class));
    }
}
