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
Release [v2](https://github.com/Katoga/allyourbase/tree/master) is tested in every supported PHP 7 and PHP 8. \
Release [v1](https://github.com/Katoga/allyourbase/tree/release-v1) is legacy and tested with PHP 5.6 only.
