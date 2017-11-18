<?php
declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$b16 = new Katoga\Allyourbase\Base16();

$encodedBinary = file_get_contents(TEST_DATA_DIR . '/data.bin.b16');

Assert::same($encodedBinary, $b16->encode($binary));
Assert::same($binary, $b16->decode($encodedBinary));
