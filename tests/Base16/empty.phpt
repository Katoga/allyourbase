<?php
declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$b16 = new Katoga\Allyourbase\Base16();

Assert::same('', $b16->encode(''));
Assert::same('', $b16->decode(''));
