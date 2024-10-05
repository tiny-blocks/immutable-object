<?php

declare(strict_types=1);

namespace TinyBlocks\Immutable;

use PHPUnit\Framework\TestCase;
use TinyBlocks\Immutable\Internal\Exceptions\ImmutableException;

final class ImmutableExceptionTest extends TestCase
{
    public function testNonScalarValueMessage(): void
    {
        /** @Given an array value and an ImmutableException */
        $key = 'data';
        $value = ['key' => 'value'];
        $class = 'TestClass';

        $exception = new class($key, $value, $class) extends ImmutableException {
            public function __construct(string $key, mixed $value, string $class)
            {
                $template = 'Property <%s> with value <%s> cannot be changed in class <%s>.';
                parent::__construct($this->withMessage($template, $key, $value, $class));
            }
        };

        /** @When we check the exception message */
        $actual = $exception->getMessage();

        /** @Then the message should be formatted properly with var_export for the non-scalar value */
        self::assertSame(
            "Property <data> with value <array (\n  'key' => 'value',\n)> cannot be changed in class <TestClass>.",
            $actual
        );
    }
}
