<?php
use Tester\Assert;

require_once __DIR__ . '/bootstrap.php';

$b64 = new Katoga\Allyourbase\Base64();

$plain = 'Hello world!';
$encoded = 'SGVsbG8gd29ybGQh';

Assert::same($encoded, $b64->encode($plain));
Assert::same($plain, $b64->decode($encoded));

Assert::exception(
	function () use ($b64) {
		$malformed = 'SGVsbG8gd29ybGQh#';
		$dummy = $b64->decode($malformed);
	},
	'\Katoga\Allyourbase\DecodeFailedException'
);
