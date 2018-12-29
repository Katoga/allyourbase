[![Build Status](https://travis-ci.org/Katoga/allyourbase.svg?branch=release-v1)](https://travis-ci.org/Katoga/allyourbase)

# Allyourbase
Collection of binary-to-ascii encoders.

## Installation
```sh
composer require katoga/allyourbase
```

## Usage
```php
$b64 = new \Katoga\Allyourbase\Base64();
$encoded = $b64->encode('Hello world!');
$plain = $b64->decode($encoded);
```

## Supported versions
Version [v1](https://github.com/Katoga/allyourbase/tree/release-v1) is deprecated and only PHP 5.6 compatibility is tested. For supported versions of PHP 7 see [v2](https://github.com/Katoga/allyourbase/tree/master).
