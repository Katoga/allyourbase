<?php
declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

$b32 = new Katoga\Allyourbase\Base32(Katoga\Allyourbase\Base32::CROCKFORD);

$encodedText = file_get_contents(TEST_DATA_DIR . '/data.txt.b32crockford');

Assert::same($encodedText, $b32->encode($text));
Assert::same($text, $b32->decode($encodedText));
