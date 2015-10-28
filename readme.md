[![Build Status](https://travis-ci.org/Katoga/allyourbase.svg?branch=master)](https://travis-ci.org/Katoga/allyourbase)

Allyourbase
===========
Collection of binary-to-ascii encoders.

Installation
------------
    php composer.phar require katoga/allyourbase

Usage
-----
    $b64 = new \Katoga\Allyourbase\Base64();
    $encoded = $b64->encode('Hello world!');
    $plain = $b64->decode($encoded);