<?php
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

$b32 = new Katoga\Allyourbase\Base32();

$encodedBinaryLowercase = file_get_contents(TEST_DATA_DIR . '/data.bin.b32crockford-lowercase');

Assert::same($binary, $b32->decode($encodedBinaryLowercase, Katoga\Allyourbase\Base32::CROCKFORD));
