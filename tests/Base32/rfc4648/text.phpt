<?php
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

$b32 = new Katoga\Allyourbase\Base32();

$encodedText = file_get_contents(TEST_DATA_DIR . '/data.txt.b32');

Assert::same($encodedText, $b32->encode($text));
Assert::same($text, $b32->decode($encodedText));

Assert::same($encodedText, $b32->encode($text, Katoga\Allyourbase\Base32::RFC4648));
Assert::same($text, $b32->decode($encodedText, Katoga\Allyourbase\Base32::RFC4648));
