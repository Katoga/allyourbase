<?php
declare(strict_types=1);

namespace Katoga\Allyourbase;

/**
 * @author Katoga <katoga.cz@hotmail.com>
 */
interface Transcoder
{
	/**
	 * @param string $input binary string
	 * @return string ascii string
	 * @throws EncodeFailedException
	 */
	public function encode(string $input): string;

	/**
	 * @param string $input ascii string
	 * @return string binary string
	 * @throws DecodeFailedException
	 */
	public function decode(string $input): string;
}
