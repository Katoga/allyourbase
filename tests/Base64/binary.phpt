<?php
declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$b64 = new Katoga\Allyourbase\Base64();

$encodedBinary = file_get_contents(TEST_DATA_DIR . '/data.bin.b64');

Assert::same($encodedBinary, $b64->encode($binary));
Assert::same($binary, $b64->decode($encodedBinary));
