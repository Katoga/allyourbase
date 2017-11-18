<?php
declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$b91 = new Katoga\Allyourbase\Base91();

$encodedBinary = file_get_contents(TEST_DATA_DIR . '/data.bin.b91');

Assert::same($encodedBinary, $b91->encode($binary));
Assert::same($binary, $b91->decode($encodedBinary));
