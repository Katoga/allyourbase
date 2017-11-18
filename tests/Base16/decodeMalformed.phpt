<?php
declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$b16 = new Katoga\Allyourbase\Base16();

Assert::exception(
	function () use ($b16) {
		$malformed = '48656c6c6f20776f726c6421z';
		$dummy = $b16->decode($malformed);
	},
	'\Katoga\Allyourbase\DecodeFailedException'
);
