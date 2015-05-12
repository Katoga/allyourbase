<?php
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
	public function encode($input)
	{
		$output = '';
		if ($input !== '') {
			$output = bin2hex($input);
		}

		return $output;
	}

	/**
	 * @param string $input ascii string
	 * @return string binary string
	 * @throws DecodeFailedException
	 */
	public function decode($input)
	{
		$output = '';
		if ($input !== '') {
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
	 */
	protected function handleDecodeErrors($errno, $errstr, $errfile = '', $errline = 0, array $errcontext = [])
	{
		restore_error_handler();
		
		throw new DecodeFailedException();
	}
}
