<?php
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$b64 = new Katoga\Allyourbase\Base64();

Assert::exception(
	function () use ($b64) {
		$malformed = 'SGVsbG8gd29ybGQh#';
		$dummy = $b64->decode($malformed);
	},
	'\Katoga\Allyourbase\DecodeFailedException'
);
