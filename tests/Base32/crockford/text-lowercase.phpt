<?php
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

$b32 = new Katoga\Allyourbase\Base32();

$encodedTextLowercase = file_get_contents(TEST_DATA_DIR . '/data.txt.b32crockford-lowercase');

Assert::same($text, $b32->decode($encodedTextLowercase, Katoga\Allyourbase\Base32::CROCKFORD));
