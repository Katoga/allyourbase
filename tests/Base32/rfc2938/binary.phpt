<?php
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

$b32 = new Katoga\Allyourbase\Base32();

$encodedBinary = file_get_contents(TEST_DATA_DIR . '/data.bin.b32rfc2938');

Assert::same($encodedBinary, $b32->encode($binary, Katoga\Allyourbase\Base32::RFC2938));
Assert::same($binary, $b32->decode($encodedBinary, Katoga\Allyourbase\Base32::RFC2938));