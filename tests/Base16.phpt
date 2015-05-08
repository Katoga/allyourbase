<?php
use Tester\Assert;

require_once __DIR__ . '/bootstrap.php';

$b16 = new Katoga\Allyourbase\Base16();

$encodedText = file_get_contents(TEST_DATA_DIR . '/data.txt.b16');
$encodedBinary = file_get_contents(TEST_DATA_DIR . '/data.bin.b16');

Assert::same($encodedText, $b16->encode($text));
Assert::same($text, $b16->decode($encodedText));

Assert::same($encodedBinary, $b16->encode($binary));
Assert::same($binary, $b16->decode($encodedBinary));

Assert::exception(
	function () use ($b16) {
		$malformed = '48656c6c6f20776f726c6421z';
		$dummy = $b16->decode($malformed);
	},
	'\Katoga\Allyourbase\DecodeFailedException'
);
