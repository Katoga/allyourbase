<?php
declare(strict_types=1);

namespace Katoga\Allyourbase;

/**
 * @author Katoga <katoga.cz@hotmail.com>
 */
class Base64 implements Transcoder
{
	/**
	 * @param string $input binary string
	 * @return string ascii string
	 * @throws EncodeFailedException
	 */
	public function encode(string $input): string
	{
		$output = '';

		if ($input !== '') {
			$output = base64_encode($input);

			if ($output === false) {
				throw new EncodeFailedException();
			}
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

		if ($input !== '') {
			$output = base64_decode($input, true);

			if ($output === false) {
				throw new DecodeFailedException();
			}
		}

		return $output;
	}
}
