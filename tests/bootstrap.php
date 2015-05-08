<?php

if (@!include __DIR__ . '/../../../autoload.php') {
	echo 'Install Nette Tester using `composer install`';
	exit(1);
}

Tester\Environment::setup();

define('TEST_DATA_DIR', __DIR__ . '/data');

$binary = file_get_contents(TEST_DATA_DIR . '/data.bin');
$text = file_get_contents(TEST_DATA_DIR . '/data.txt');
