<?php
declare(strict_types=1);

namespace Katoga\Allyourbase;

use InvalidArgumentException;

/**
 * @author Katoga <katoga.cz@hotmail.com>
 */
class Base32 implements Transcoder
{

	/**
	 * New RFC that obsoleted RFC3548, uses the same alphabet.
	 *
	 * A-Z, 2-7
	 *
	 * @var int
	 */
	public const RFC4648 = 1;

	/**
	 * "Extended hex" or "base32hex".
	 *
	 * 0-9, A-V
	 *
	 * @var int
	 */
	public const RFC2938 = 2;

	/**
	 * Douglas Crockford's vairant
	 *
	 * 0-9, A-Z without I, L, O, U
	 *
	 * @link https://www.crockford.com/wrmg/base32.html
	 * @var int
	 */
	public const CROCKFORD = 3;

	/**
	 * @var string
	 */
	protected const PAD_CHAR = '=';

	/**
	 * @var int
	 */
	protected int $type = self::RFC4648;

	/**
	 * @var array<int, array<int, string>>
	 */
	protected array $alphabet = [
		self::RFC4648 => [],
		self::RFC2938 => [],
		self::CROCKFORD => [],
	];

	/**
	 * @param int $type type of alphabet to use
	 */
	public function __construct(int $type = self::RFC4648)
	{
		$this->type = $type;
	}

	/**
	 * @param string $input binary string
	 * @return string ascii string
	 */
	public function encode(string $input): string
	{
		$output = '';

		if ($input != '') {
			$alphabet = $this->getAlphabet($this->type);

			// create binary represantation of input string
			$binStr = '';
			foreach (str_split($input) as $char) {
				// append 8 bits of source string
				// padding zeros needed for chars with ASCII position < 64 (up to '?')
				// or portions of splitted multibyte chars
				$binStr .= str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
			}

			// pad binary string, its length has to be divisible by 5
			$binStr = $this->pad($binStr, 5, '0');

			// split binary string to 5bit chunks
			$binArr = explode(' ', trim(chunk_split($binStr, 5, ' ')));

			// encode
			foreach ($binArr as $binChar) {
				$output .= $alphabet[bindec($binChar)];
			}

			// pad output, its length has to be divisible by 8
			$output = $this->pad($output, 8, static::PAD_CHAR);
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
			$alphabet = array_flip($this->getAlphabet($this->type));

			if ($this->type == static::CROCKFORD) {
				$input = str_ireplace(
					['i', 'l', 'o'],
					['1', '1', '0'],
					$input,
				);
			}

			$input = strtoupper($input);

			$input = rtrim($input, static::PAD_CHAR);

			$binStr = '';
			foreach (str_split($input) as $ch) {
				if (!isset($alphabet[$ch])) {
					throw new DecodeFailedException();
				}

				// append 5bit binary representation of encoded char
				$binStr .= str_pad((decbin($alphabet[$ch])), 5, '0', STR_PAD_LEFT);
			}

			// trim the right side of binary string, its length has to be divisible by 8
			$binStr = $this->trim($binStr, 8);

			$binArr = explode(' ', trim(chunk_split($binStr, 8, ' ')));

			foreach ($binArr as $bin) {
				$output .= chr((int) bindec($bin));
			}
		}

		return $output;
	}

	/**
	 * Pads $string on right side with $char to length divisible by $factor
	 *
	 * @param string $string
	 * @param int $factor
	 * @param string $char
	 * @return string
	 */
	protected function pad(string $string, int $factor, string $char): string
	{
		$output = $string;

		$length = strlen($string);
		$modulo = $length % $factor;
		if ($modulo != 0) {
			$outputPaddedLength = $length + ($factor - $modulo);
			$output = str_pad($output, $outputPaddedLength, $char, STR_PAD_RIGHT);
		}

		return $output;
	}

	/**
	 * Trims $char from right side of $string to length divisible by $factor
	 *
	 * @param string $string
	 * @param int $factor
	 * @return string
	 */
	protected function trim(string $string, int $factor): string
	{
		$output = $string;

		$length = strlen($string);
		$modulo = $length % $factor;
		if ($modulo != 0) {
			$outputTrimmedLength = $length - $modulo;
			$output = substr($output, 0, $outputTrimmedLength);
		}

		return $output;
	}

	/**
	 * @var int $type
	 * @return array<int, string>
	 */
	protected function getAlphabet(int $type): array
	{
		$this->checkAlphabetType($type);

		if (!$this->alphabet[$type]) {
			$this->generateAlphabet($type);
		}

		return $this->alphabet[$type];
	}

	/**
	 * @var int $type
	 * @return void
	 */
	protected function generateAlphabet(int $type): void
	{
		$this->checkAlphabetType($type);

		switch ($type) {
			case static::RFC4648:
				$this->alphabet[$type] = array_merge(
					range('A', 'Z'),
					array_map(
						'strval',
						range('2', '7'),
					),
				);
				break;
			case static::RFC2938:
				$this->alphabet[$type] = array_merge(
					array_map(
						'strval',
						range('0', '9'),
					),
					range('A', 'V'),
				);
				break;
			case static::CROCKFORD:
				$this->alphabet[$type] = array_merge(
					array_map(
						'strval',
						range('0', '9'),
					),
					range('A', 'H'),
					range('J', 'K'),
					range('M', 'N'),
					range('P', 'T'),
					range('V', 'Z'),
				);
				break;
		}
	}

	/**
	 * @var int $type
	 * @return void
	 * @throws InvalidArgumentException
	 */
	protected function checkAlphabetType(int $type): void
	{
		if (!array_key_exists($type, $this->alphabet)) {
			throw new InvalidArgumentException(
				sprintf(
					'Wrong type provided: "%s", supported types: "%s"',
					$type,
					implode('", "', array_keys($this->alphabet))
				)
			);
		}
	}
}
