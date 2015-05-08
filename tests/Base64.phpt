<?php
use Tester\Assert;

require_once __DIR__ . '/bootstrap.php';

$b64 = new Katoga\Allyourbase\Base64();

$encodedText = file_get_contents(TEST_DATA_DIR . '/data.txt.b64');
$encodedBinary = file_get_contents(TEST_DATA_DIR . '/data.bin.b64');

Assert::same($encodedText, $b64->encode($text));
Assert::same($text, $b64->decode($encodedText));

Assert::same($encodedBinary, $b64->encode($binary));
Assert::same($binary, $b64->decode($encodedBinary));

Assert::exception(
	function () use ($b64) {
		$malformed = 'SGVsbG8gd29ybGQh#';
		$dummy = $b64->decode($malformed);
	},
	'\Katoga\Allyourbase\DecodeFailedException'
);
