<?php
declare(strict_types=1);

namespace Katoga\Allyourbase;

/**
 * @author Joachim Henke
 * @author Katoga <katoga.cz@hotmail.com>
 */
class Base91 implements Transcoder
{
	/**
	 * @var array<string>
	 */
	protected $alphabet;

	/**
	 * @param string $input binary string
	 * @return string ascii string
	 * @SuppressWarnings(PHPMD.ElseExpression)
	 * @SuppressWarnings(PHPMD.ShortVariable)
	 */
	public function encode(string $input): string
	{
		$output = '';

		if ($input != '') {
			$alphabet = $this->getAlphabet();

			$length = strlen($input);
			$b = null;
			$n = null;

			for ($i = 0; $i < $length; $i++) {
				$b |= ord($input[$i]) << $n;
				$n += 8;

				if ($n > 13) {
					$v = $b & 8191;

					if ($v > 88) {
						$b >>= 13;
						$n -= 13;
					} else {
						$v = $b & 16383;
						$b >>= 14;
						$n -= 14;
					}

					$output .= $alphabet[$v % 91] . $alphabet[$v / 91];
				}
			}

			if ($n) {
				$output .= $alphabet[$b % 91];
				if ($n > 7 || $b > 90) {
					$output .= $alphabet[$b / 91];
				}
			}
		}

		return $output;
	}

	/**
	 * @param string $input ascii string
	 * @return string binary string
	 * @throws DecodeFailedException
	 * @SuppressWarnings(PHPMD.ElseExpression)
	 * @SuppressWarnings(PHPMD.ShortVariable)
	 */
	public function decode(string $input): string
	{
		$output = '';

		if ($input != '') {
			$alphabet = $this->getDecodingAlphabet();

			$length = strlen($input);
			$b = null;
			$n = null;
			$v = -1;

			for ($i = 0; $i < $length; $i++) {
				if (!isset($alphabet[$input[$i]])) {
						throw new DecodeFailedException();
				}

				$c = $alphabet[$input[$i]];

				if ($v < 0) {
						$v = $c;
				} else {
					$v += $c * 91;
					$b |= $v << $n;
					$n += ($v & 8191) > 88 ? 13 : 14;
					do {
						$output .= chr($b & 255);
						$b >>= 8;
						$n -= 8;
					} while ($n > 7);
					$v = -1;
				}
			}
			if ($v + 1) {
					$output .= chr(($b | $v << $n) & 255);
			}
		}

		return $output;
	}

	/**
	 * @return array<int>
	 */
	protected function getDecodingAlphabet(): array
	{
		return array_flip($this->getAlphabet());
	}

	/**
	 * @return array<string>
	 */
	protected function getAlphabet(): array
	{
		if (!$this->alphabet) {
			$this->alphabet = array_merge(
				range('A', 'Z'),
				range('a', 'z'),
				[
					'0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
					'!', '#', '$', '%', '&',
					'(', ')', '*', '+', ',',
					'.', '/',
					':', ';', '<', '=', '>', '?', '@', '[', ']', '^', '_',
					'`', '{', '|', '}', '~', '"'
				]
			);
		}

		return $this->alphabet;
	}
}
