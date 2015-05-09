<?php
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$b64 = new Katoga\Allyourbase\Base64();

$encodedText = file_get_contents(TEST_DATA_DIR . '/data.txt.b64');

Assert::same($encodedText, $b64->encode($text));
Assert::same($text, $b64->decode($encodedText));
