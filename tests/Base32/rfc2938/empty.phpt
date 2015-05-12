<?php
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

$b32 = new Katoga\Allyourbase\Base32();

Assert::same('', $b32->encode('', Katoga\Allyourbase\Base32::RFC2938));
Assert::same('', $b32->decode('', Katoga\Allyourbase\Base32::RFC2938));
