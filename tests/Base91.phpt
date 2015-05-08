<?php
use Tester\Assert;

require_once __DIR__ . '/bootstrap.php';

$b91 = new Katoga\Allyourbase\Base91();

$encodedText = file_get_contents(TEST_DATA_DIR . '/data.txt.b91');
$encodedBinary = file_get_contents(TEST_DATA_DIR . '/data.bin.b91');

Assert::same($encodedText, $b91->encode($text));
Assert::same($text, $b91->decode($encodedText));

Assert::same($encodedBinary, $b91->encode($binary));
Assert::same($binary, $b91->decode($encodedBinary));

Assert::exception(
	function () use ($b91) {
		$malformed = '>OwJh>Io2Tv!8PE-';
		$dummy = $b91->decode($malformed);
	},
	'\Katoga\Allyourbase\DecodeFailedException'
);
