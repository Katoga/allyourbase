# Allyourbase CHANGELOG
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [5.0.0] - 2023-12-23
### Added
- PHP 8.2 support
### Changed
- `phpmd/phpmd` 2.13 -> 2.15
- `squizlabs/php_codesniffer` 3.7 -> 3.8
### Removed
- PHP 8.0 support

## [4.0.0] - 2022-11-15
### Added
- PHP 8.1 support
- Github Actions testing
### Changed
- `nette/tester` 2.3 -> 2.4
- `phpmd/phpmd` 2.9 -> 2.13
- `squizlabs/php_codesniffer` 3.5 -> 3.7
- `phpstan/phpstan` 0.12 -> 1.9
### Removed
- PHP 7.4 support
- Travis CI testing

## [3.0.0] - 2021-03-17
### Added
- PHP 8.0 support
- dependency graph image
### Changed
- docs generation tool
- `sebastian/phpcpd` 4.2 -> 6.0
- `phpmd/phpmd` 2.7 -> 2.9
### Deprecated
- PHP 7.4 support
### Removed
- PHP 7.3 support
### Fixed
- `phpstan` level 8

## [2.3.0] - 2019-12-17
### Added
- PHP 7.4 support
### Changed
- `nette/tester` 2.1 -> 2.3
- `phpmd/phpmd` 2.6 -> 2.7
- `squizlabs/php_codesniffer` 3.3 -> 3.5
- `phpstan/phpstan` 0.10 -> 0.12
### Removed
- `compose.lock` git tracking
### Fixed
- PHP 7.4 deprecated syntax in Base91
- phpstan level 5

## [2.2.0] - 2018-12-29
### Added
- PHP 7.3 support
### Changed
- `nette/tester` 2.0 -> 2.1
- `sebastian/phpcpd` 4.0 -> 4.1
- `squizlabs/php_codesniffer` 3.2 -> 3.3
- `phpstan/phpstan` 0.9 -> 0.10

## [1.3.0] - 2018-12-29
### Removed
- PHP 5.4 support
- PHP 5.5 support
- PHP 7.* support

## [1.2.2] - 2018-03-18
### Added
- PHP 7.1 and 7.2 in Travis CI testing
- `roave/security-advisories` Composer dev dependency
### Changed
### Deprecated
### Removed
- `compose.lock` git tracking
### Fixed
### Security

## [2.1.0] - 2018-03-18
### Added
- PHP 7.2 support
### Changed
- Composer dependencies versions

## [2.0.0] - 2017-11-18
### Added
- phpstan Travis CI testing
- strict_types declaration
- scalar type hints
- generated docs
### Changed
- Composer dependencies versions
- phpcs indentation rules
- phpmd ruleset converted to cli args
### Removed
- PHP 5.* support
- HHVM Travis CI testing
- `compose.lock` git tracking
- tests output git tracking

## [1.2.1] - 2017-11-18
### Added
- phpcs ruleset
- phpmd ruleset
- testing in Travis CI
### Changed
- Base32 internals
### Removed
- `compose.lock` git tracking

## [1.2.0] - 2015-08-05
### Added
- Bae32 Douglas Crockford's variant

## [1.1.0] - 2015-05-12
### Added
- Base32 RFC4648
- Base32 RFC2938

## [1.0.1] - 2015-05-12
### Fixed
- Base16 decoding

## [1.0.0] - 2015-05-09
### Added
- Base16
- Base64
- Base91
