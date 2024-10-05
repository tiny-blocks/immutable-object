<?php

declare(strict_types=1);

namespace TinyBlocks\Immutable\Internal\Exceptions;

final class PropertyCannotBeDeactivated extends ImmutableException
{
    public function __construct(string $key, string $class)
    {
        $template = 'Property <%s> cannot be deactivated in class <%s>.';
        parent::__construct(message: $this->withMessage($template, $key, $class));
    }
}
