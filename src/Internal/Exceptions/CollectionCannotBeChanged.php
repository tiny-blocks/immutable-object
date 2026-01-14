<?php

declare(strict_types=1);

namespace TinyBlocks\Immutable\Internal\Exceptions;

final class CollectionCannotBeChanged extends ImmutableException
{
    public function __construct(
        private readonly mixed $offset,
        private readonly mixed $value,
        private readonly string $class
    ) {
        $template = 'Cannot modify collection element at offset <%s> with value <%s> in class <%s>.';

        parent::__construct(message: $this->withMessage($template, $this->offset, $this->value, $this->class));
    }
}
