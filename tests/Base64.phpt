<?php
use Tester\Assert;

require_once __DIR__ . '/bootstrap.php';

$b64 = new Katoga\Allyourbase\Base64();

$plain = 'Helo world!';
$encoded = 'SGVsbyB3b3JsZCE=';

Assert::same($encoded, $b64->encode($plain));
Assert::same($plain, $b64->decode($encoded));

Assert::exception(
	function () use ($b64) {
		$malformed = 'SGVsbyB3b3JsZCE#';
		$dummy = $b64->decode($malformed);
	},
	'DecodeFailedException'
);
