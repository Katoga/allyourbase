[![Build Status](https://travis-ci.org/Katoga/allyourbase.svg?branch=master)](https://travis-ci.org/Katoga/allyourbase)

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
- [v3](https://github.com/Katoga/allyourbase/tree/master): PHP 8
- [v2](https://github.com/Katoga/allyourbase/tree/release-v2): PHP 7.4
- [v1](https://github.com/Katoga/allyourbase/tree/release-v1): PHP 5.6
