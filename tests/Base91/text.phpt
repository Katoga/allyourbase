<?php
declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$b91 = new Katoga\Allyourbase\Base91();

$encodedText = file_get_contents(TEST_DATA_DIR . '/data.txt.b91');

Assert::same($encodedText, $b91->encode($text));
Assert::same($text, $b91->decode($encodedText));
