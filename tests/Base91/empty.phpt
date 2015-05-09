<?php
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$b91 = new Katoga\Allyourbase\Base91();

Assert::same('', $b91->encode(''));
Assert::same('', $b91->decode(''));
