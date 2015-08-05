<?php
namespace Katoga\Allyourbase;

/**
 * @author Katoga <katoga.cz@hotmail.com>
 * @todo Douglas Crockford's variant - it is more loose (decoding treats I and L as 1 and O as 0)
 */
class Base32 implements Transcoder
{

	/**
	 * A-Z, 2-7
	 * New RFC that obsoleted RFC3548, uses the same alphabet.
	 *
	 * @var int
	 */
	const RFC4648 = 1;

	/**
	 * 0-9, A-V 
	 * "Extended hex" or "base32hex"
	 *
	 * @var int
	 */
	const RFC2938 = 2;

	/**
	 * 0-9, A-Z without I, L, O, U
	 *
	 * @link http://www.crockford.com/wrmg/base32.html
	 * @var int
	 */
	const CROCKFORD = 3;

	/**
	 * @var string
	 */
	const PAD_CHAR = '=';

	/**
	 * @var array
	 */
	protected $alphabet = [];

	/**
	 * @param string $input binary string
	 * @param int $type alphabet type
	 * @return string ascii string
	 */
	public function encode($input, $type = self::RFC4648)
	{
		$output = '';

		if ($input !== '') {
			$alphabet = $this->getAlphabet($type);
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
			$output = $this->pad($output, 8, self::PAD_CHAR);
		}

		return $output;
	}

	/**
	 * @param string $input ascii string
	 * @param int $type alphabet type
	 * @return string binary string
	 * @throws DecodeFailedException
	 */
	public function decode($input, $type = self::RFC4648)
	{
		$output = '';

		if ($input !== '') {
			$alphabet = $this->getDecodingAlphabet($type);

			// convert input to uppercase and remove trailing padding chars
			$input = rtrim(strtoupper($input), self::PAD_CHAR);

			$binStr = '';
			foreach (str_split($input) as $ch) {
				if (!isset($alphabet[$ch])) {
					throw new DecodeFailedException();
				}

				// append 5bit binary representation of encoded char
				$binStr .= str_pad((decbin($alphabet[$ch])), 5, '0', STR_PAD_LEFT);
			}

			// trim zeros from tight side of binary string, its length has to be divisible by 8
			$binStr = $this->trim($binStr, 8, '0');

			$binArr = explode(' ', trim(chunk_split($binStr, 8, ' ')));

			foreach ($binArr as $bin) {
				$output .= chr(bindec($bin));
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
	 */
	protected function pad($string, $factor, $char)
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
	 * @param string $char
	 */
	protected function trim($string, $factor, $char)
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
	 * @param int $type
	 * @return array
	 */
	protected function getDecodingAlphabet($type)
	{
		$alphabet = array_flip($this->getAlphabet($type));

		if ($type == self::CROCKFORD) {
			$alphabet['I'] = 1;
			$alphabet['L'] = 1;
			$alphabet['O'] = 0;

			// add lowercase
			$lowercase = range('a', 'z');
			unset($lowercase[20]);
			foreach ($lowercase as $ch) {
				$alphabet[$ch] = $alphabet[strtoupper($ch)];
			}
		}

		return $alphabet;
	}

	/**
	 * @param int $type
	 * @return array
	 * @throws \InvalidArgumentException
	 */
	protected function getAlphabet($type)
	{
		if (empty($this->alphabet[$type])) {
			$alphaRange = range('A', 'Z');
			$numRange = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

			switch ($type) {
				case self::RFC4648:
					// exclude 0, 1, 8, 9
					$numRange = array_slice($numRange, 2, -2);
					$alphabet = array_merge($alphaRange, $numRange);
					break;

				case self::RFC2938:
					// exclude W, X, Y, Z
					$alphaRange = array_slice($alphaRange, 0, -4);
					$alphabet = array_merge($numRange, $alphaRange);
					break;

				case self::CROCKFORD:
					// exclude I, L, O, U
					unset($alphaRange[8], $alphaRange[11], $alphaRange[14], $alphaRange[20]);
					$alphabet = array_merge($numRange, $alphaRange);
					break;

				default:
					throw new \InvalidArgumentException(sprintf('Wrong alphabet provided: "%s"!', $alphabet));
			}

			$this->alphabet[$type] = $alphabet;
		}

		return $this->alphabet[$type];
	}
}
