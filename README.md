# Immutable Object

[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)

* [Overview](#overview)
* [Installation](#installation)
* [How to use](#how-to-use)
* [License](#license)
* [Contributing](#contributing)

<div id='overview'></div>

## Overview

The **Immutable Object** library ensures that objects implementing it remain immutable after initialization. Once
created, the state of the object cannot be modified. Any attempt to change properties or collection elements will throw
an exception.

<div id='installation'></div>

## Installation

```bash
composer require tiny-blocks/immutable-object
```

<div id='how-to-use'></div>

## How to use

The library provides the `Immutable` interface and the `Immutability` trait to guarantee immutability. These components
prevent properties and collections from being modified or unset.

### Concrete implementation

By implementing the `Immutable` interface and using the `Immutability` trait, you can ensure that object properties and
elements in collections are immutable.

```php
<?php

namespace Example;

use TinyBlocks\Immutable\Immutable;
use TinyBlocks\Immutable\Immutability;

final class Order implements Immutable
{
    use Immutability;

    public function __construct(public int $id, public Products $products)
    {
    }
}
```

#### Handling property immutability

The Immutability trait also prevents modifications to properties of an object. Trying to modify a property after the
object is initialized will throw an exception.

```php
$order = new Order(id: 1, products: new Products(array: ['item1', 'item2']);

$order->id = 2;    # Throws an exception
unset($order->id); # Throws an exception  
```

#### Handling collection immutability

The `Immutability` trait also prevents the modification of collection elements (e.g., arrays). Trying to modify or
remove an element will throw an exception.

```php
$order = new Order(id: 1, products: new Products(array: ['item1', 'item2']);

$order->items[0] = 'item3'; # Throws an exception
unset($order->items[0]);    # Throws an exception
```

<div id='license'></div>

## License

Immutable Object is licensed under [MIT](LICENSE).

<div id='contributing'></div>

## Contributing

Please follow the [contributing guidelines](https://github.com/tiny-blocks/tiny-blocks/blob/main/CONTRIBUTING.md) to
contribute to the project.
