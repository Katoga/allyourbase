<?php
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$b64 = new Katoga\Allyourbase\Base64();

Assert::same('', $b64->encode(''));
Assert::same('', $b64->decode(''));
