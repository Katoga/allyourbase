<?php

if (@!include __DIR__ . '/../../../autoload.php') {
	echo 'Install Nette Tester using `composer install`';
	exit(1);
}

Tester\Environment::setup();
