<?php
declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$b91 = new Katoga\Allyourbase\Base91();

Assert::exception(
	function () use ($b91) {
		$malformed = '>OwJh>Io2Tv!8PE-';
		$dummy = $b91->decode($malformed);
	},
	'\Katoga\Allyourbase\DecodeFailedException'
);
