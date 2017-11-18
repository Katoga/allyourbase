<?php
declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

$b32 = new Katoga\Allyourbase\Base32();

Assert::same('', $b32->encode(''));
Assert::same('', $b32->decode(''));

Assert::same('', $b32->encode(''));
Assert::same('', $b32->decode(''));
