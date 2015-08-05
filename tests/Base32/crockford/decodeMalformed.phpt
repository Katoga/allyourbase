<?php
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

$b32 = new Katoga\Allyourbase\Base32();

Assert::exception(
	function () use ($b32) {
		$malformed = '48656c6c6f20776f726c6421U';
		$dummy = $b32->decode($malformed, Katoga\Allyourbase\Base32::CROCKFORD);
	},
	'\Katoga\Allyourbase\DecodeFailedException'
);
