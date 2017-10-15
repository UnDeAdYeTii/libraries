<?php
namespace YeTii\General;

use YeTii\General\Arr;

class Num {


	public static function toRomanNumerals($integer = 0) {
		$integer = (int)$integer;
		$table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1);
		$return = '';
		while($integer > 0)  {
			foreach($table as $rom=>$arb) {
				if($integer >= $arb) {
					$integer -= $arb;
					$return .= $rom;
					break; 
				}
			}
		}
		return $return;
	}

	public static function romanNumeralsToInt(string $orig) {
		$string = strtoupper($orig);
		if (!preg_match('/^[IVXLCDM]+$/', $string))
			return false;
		$numerals = array('M'=>1000,'CM'=>900,'D'=>500,'CD'=>400,'C'=>100,'XC'=>90,'L'=>50,'XL'=>40,'X'=>10,'IX'=>9,'V'=>5,'IV'=>4,'I'=>1);
		$result = 0; $blacklist = [];
		foreach ($numerals as $key => $value) {
			if (in_array($key, $blacklist)) return false;
			for ($i=0;$i<3;$i++) {  // max 3 in a row
				if (strpos($string, $key) === 0) {
					$result += $value;
					$string = substr($string, strlen($key));
					if (strlen($key)==2)
						$blacklist[] = $key[1];
				}
				if (!in_array($key, ['M','C','X','I']))
					$i=3;
			}
			$blacklist[] = $key;
		}
		return $result;
	}

	public static function isRomanNumerals(string $string) {
		return boolval(self::romanNumeralsToInt($string));
	}

	public static function readMath(string $string) {
		if (preg_match('/^(\d+)\s*([\-\+\/\*])\s*(\d+)$/', $string, $m)) {
			return self::customEquation($m[1],$m[2],$m[3]);
		}else{
			return false;
		}
	}

	public static function customEquation($arg1, $modifier, $arg2) {
		switch ($modifier) {
			case '<':
				return $arg1 < $arg2;
			case '<=':
			case '=<':
			case '!>':
				return $arg1 <= $arg2;
			case '>':
				return $arg1 > $arg2;
			case '>=':
			case '=>':
			case '!<':
				return $arg1 >= $arg2;
			case '==':
			case '=':
				return $arg1 == $arg2;
			case '+':
				return $arg1 + $arg2;
			case '-':
				return $arg1 - $arg2;
			case '*':
			case '×':
				return $arg1 * $arg2;
			case '/':
			case '÷':
				return $arg1 / $arg2;
			case '^';
				return pow($arg1, $arg2);
			case '√':
				return sqrt($arg2);
			default:
				return NULL;
		}
	}

	public static function padZero($int, $length = 4) {
		$int = (string)$int;
		while(strlen($int)<$length) {
			$int = '0'.$int;
		}
		return $int;
	}

}