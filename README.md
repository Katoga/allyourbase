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
| PHP | [v1](https://github.com/Katoga/allyourbase/tree/release-v1) | [v2](https://github.com/Katoga/allyourbase/tree/master) |
| --- | --- | --- |
| 5.4 | 🗸 | ❌ |
| 5.5 | 🗸 | ❌ |
| 5.6 | ✔️ | ❌ |
| 7.0 | 🗸 | ❌ |
| 7.1 | 🗸 | ✔️ |
| 7.2 | 🗸 | ✔️ |

✔️ preferred (should be used)  
🗸 supported (can but shouldn't be used)  
❌ unsupported  (can't be used)
