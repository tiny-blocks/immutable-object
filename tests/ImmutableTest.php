<?php

declare(strict_types=1);

namespace TinyBlocks\Immutable;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use TinyBlocks\Immutable\Internal\Exceptions\CollectionCannotBeChanged;
use TinyBlocks\Immutable\Internal\Exceptions\CollectionCannotBeDeactivated;
use TinyBlocks\Immutable\Internal\Exceptions\PropertyCannotBeChanged;
use TinyBlocks\Immutable\Internal\Exceptions\PropertyCannotBeDeactivated;
use TinyBlocks\Immutable\Models\Amount;
use TinyBlocks\Immutable\Models\Order;
use TinyBlocks\Immutable\Models\Products;

final class ImmutableTest extends TestCase
{
    #[DataProvider('dataProviderForSet')]
    public function testExceptionWhenPropertyCannotBeChangedUsingMagicSet(
        object $object,
        mixed $propertyKey,
        mixed $propertyValue
    ): void {
        /** @Given an object with defined properties */
        /** @Then we expect an exception to be thrown when trying to change the property */
        $template = 'Property <%s> with value <%s> cannot be changed in class <%s>.';
        $this->expectException(PropertyCannotBeChanged::class);
        $this->expectExceptionMessage(sprintf($template, $propertyKey, $propertyValue, $object::class));

        /** @When we attempt to modify the property using the __set magic method */
        $object->__set(key: $propertyKey, value: $propertyValue);
    }

    #[DataProvider('dataProviderForUnset')]
    public function testExceptionWhenPropertyCannotBeDeactivatedUsingMagicUnset(
        object $object,
        mixed $propertyKey
    ): void {
        /** @Given an object with defined properties */
        /** @Then we expect an exception to be thrown when trying to unset the property */
        $template = 'Property <%s> cannot be deactivated in class <%s>.';
        $this->expectException(PropertyCannotBeDeactivated::class);
        $this->expectExceptionMessage(sprintf($template, $propertyKey, $object::class));

        /** @When we attempt to unset the property using the __unset magic method */
        $object->__unset(key: $propertyKey);
    }

    public function testExceptionWhenCollectionCannotBeChanged(): void
    {
        /** @Given an immutable collection */
        $collection = new Products(array: ['Product A', 'Product B']);

        /** @Then we expect a CollectionCannotBeChanged exception when trying to modify the collection */
        $template = 'Cannot modify collection element at offset <%s> with value <%s> in class <%s>.';
        $this->expectException(CollectionCannotBeChanged::class);
        $this->expectExceptionMessage(sprintf($template, 0, 'New Product', $collection::class));

        /** @When we attempt to modify the collection using offsetSet */
        $collection->offsetSet(offset: 0, value: 'New Product');
    }

    public function testExceptionWhenCollectionCannotBeDeactivated(): void
    {
        /** @Given an immutable collection */
        $collection = new Products(array: ['Product X', 'Product Y']);

        /** @Then we expect a CollectionCannotBeDeactivated exception when trying to unset an item from the collection */
        $template = 'Cannot unset collection element at offset <%s> in class <%s>.';
        $this->expectException(CollectionCannotBeDeactivated::class);
        $this->expectExceptionMessage(sprintf($template, 0, $collection::class));

        /** @When we attempt to unset an item from the collection using offsetUnset */
        $collection->offsetUnset(offset: 0);
    }

    public static function dataProviderForSet(): array
    {
        return [
            'Order object'  => [
                'object'        => new Order(id: 1, products: new Products(['Product 1', 'Product 2'])),
                'propertyKey'   => 'id',
                'propertyValue' => 10
            ],
            'Amount object' => [
                'object'        => new Amount(value: 100.0, currency: 'USD'),
                'propertyKey'   => 'value',
                'propertyValue' => 200.10
            ]
        ];
    }

    public static function dataProviderForUnset(): array
    {
        return [
            'Order object'  => [
                'object'      => new Order(id: 1, products: new Products(['Product 1', 'Product 2'])),
                'propertyKey' => 'id'
            ],
            'Amount object' => [
                'object'      => new Amount(value: 100.0, currency: 'USD'),
                'propertyKey' => 'value'
            ]
        ];
    }
}
