<?php
use Tester\Assert;

require_once __DIR__ . '/bootstrap.php';

$b91 = new Katoga\Allyourbase\Base64();

$plain = 'Hello world!';
$encoded = '>OwJh>Io2Tv!8PE';

Assert::same($encoded, $b91->encode($plain));
Assert::same($plain, $b91->decode($encoded));

Assert::exception(
	function () use ($b91) {
		$malformed = '>OwJh>Io2Tv!8PE-';
		$dummy = $b91->decode($malformed);
	},
	'\Katoga\Allyourbase\DecodeFailedException'
);
