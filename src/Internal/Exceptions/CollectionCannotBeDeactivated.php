<?php

declare(strict_types=1);

namespace TinyBlocks\Immutable\Internal\Exceptions;

final class CollectionCannotBeDeactivated extends ImmutableException
{
    public function __construct(mixed $offset, string $class)
    {
        $template = 'Cannot unset collection element at offset <%s> in class <%s>.';
        parent::__construct(message: $this->withMessage($template, $offset, $class));
    }
}
