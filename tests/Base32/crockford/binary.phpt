<?php
declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

$b32 = new Katoga\Allyourbase\Base32(Katoga\Allyourbase\Base32::CROCKFORD);

$encodedBinary = file_get_contents(TEST_DATA_DIR . '/data.bin.b32crockford');

Assert::same($encodedBinary, $b32->encode($binary));
Assert::same($binary, $b32->decode($encodedBinary));
