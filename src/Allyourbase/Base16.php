<?php
declare(strict_types=1);

namespace Katoga\Allyourbase;

/**
 * @author Katoga <katoga.cz@hotmail.com>
 */
class Base16 implements Transcoder
{
	/**
	 * @param string $input binary string
	 * @return string ascii string
	 */
	public function encode(string $input): string
	{
		$output = '';
		if ($input != '') {
			$output = bin2hex($input);
		}

		return $output;
	}

	/**
	 * @param string $input ascii string
	 * @return string binary string
	 * @throws DecodeFailedException
	 */
	public function decode(string $input): string
	{
		$output = '';
		if ($input != '') {
			set_error_handler([$this, 'handleDecodeErrors']);

			$output = hex2bin($input);

			restore_error_handler();
		}

		return $output;
	}

	/**
	 * @param int $errno
	 * @param string $errstr
	 * @param string $errfile
	 * @param int $errline
	 * @param array $errcontext
	 * @throws DecodeFailedException
	 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
	 */
	protected function handleDecodeErrors(
		int $errno,
		string $errstr,
		string $errfile = '',
		int $errline = 0,
		array $errcontext = []
	) {
		restore_error_handler();

		throw new DecodeFailedException();
	}
}
