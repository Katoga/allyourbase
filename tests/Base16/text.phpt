<?php
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$b16 = new Katoga\Allyourbase\Base16();

$encodedText = file_get_contents(TEST_DATA_DIR . '/data.txt.b16');

Assert::same($encodedText, $b16->encode($text));
Assert::same($text, $b16->decode($encodedText));
