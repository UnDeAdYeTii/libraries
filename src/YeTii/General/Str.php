<?php
namespace YeTii\General;

use YeTii\General\Num;

class Str {

	public $value;

	public function __construct($str = null) {
		if (!is_null($str))
			$this->value = (string)$str;
	}

	public function __call($name, $arguments) {
		if (method_exists($this, $name)) {
			array_unshift($arguments, $this->value);
			return call_user_func_array([$this, $name], $arguments);
		}
	}

	public static function __callStatic($name, $arguments) {
		$s = new Str();
		return call_user_func_array([$s, $name], $arguments);
	}

	public function __toString() {
		return $this->value;
	}

	private function contains(string $haystack, string $needle, $ignoreCase = false) {
		return boolval($ignoreCase ? substr_count(strtolower($haystack), strtolower($needle)) : substr_count($haystack, $needle));
	}

	private function indexFirst(string $haystack, string $needle, $ignoreCase = false) {
		return $ignoreCase ? stripos($haystack, $needle) : strpos($haystack, $needle);
	}

	private function indexLast(string $haystack, string $needle, $ignoreCase = false) {
		return $ignoreCase ? strripos($haystack, $needle) : strrpos($haystack, $needle);
	}

	private function startsWith(string $haystack, string $needle, $ignoreCase = false) {
		return boolval($needle === "" || ($ignoreCase ? strripos($haystack, $needle, -strlen($haystack)) : strrpos($haystack, $needle, -strlen($haystack))) !== false);
	}

	private function endsWith(string $haystack, string $needle, $ignoreCase = false) {
		return boolval($needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && ($ignoreCase ? stripos($haystack, $needle, $temp) : strpos($haystack, $needle, $temp)) !== false));
	}

	private function afterLast(string $string, string $delimiter, $ignoreCase = false) {
		$pos = $this->indexLast($string, $delimiter, $ignoreCase);
		$this->value = $pos ? substr($string, $pos + 1) : $string;
		return $this;
	}

	private function beforeLast(string $string, string $delimiter, $ignoreCase = false) {
		$this->value = substr($string, 0, ($ignoreCase ? strripos($string, $delimiter) : strrpos($string, $delimiter)));
		return $this;
	}

	private function afterFirst(string $string, string $delimiter, $ignoreCase = false) {
		$pos = $this->indexFirst($string, $delimiter, $ignoreCase);
		$this->value = $pos ? substr($string, $pos+1) : ''; 
		return $this;
	}

	private function beforeFirst(string $string, string $delimiter, $ignoreCase = false) {
		$this->value = substr($string, 0, $this->indexFirst($string, $delimiter, $ignoreCase));
		return $this;
	}

	private function first(string $string, int $length) {
		$this->value = strlen($string)<$length ? $string : substr($string, 0, $length);
		return $this;
	}

	private function last(string $string, int $length) {
		$this->value = strlen($string)<$length ? $string : substr($string, -$length);
		return $this;
	}

	private function isLowerCase(string $string) {
		return boolval($string===strtolower($string));
	}

	private function isUpperCase(string $string) {
		return boolval($string===strtoupper($string));
	}

	private function toLowerCase(string $string) {
		$this->value = strtolower($string);
		return $this;
	}

	private function toUpperCase(string $string) {
		$this->value = strtoupper($string);
		return $this;
	}

	private function isCapitalized(string $string) {
		return boolval(strlen($string) ? $string[0]==strtoupper($string[0]) : false);
	}

	private function isCapitalizedWords(string $string, $forceLowerCaseOther = false) {
		return boolval($string==strval($this->capitalizeWords($string, $forceLowerCaseOther)));
	}

	private function capitalizeWords(string $string, $forceLowerCaseOther = false) {
		$string = $forceLowerCaseOther ? ucwords(strtolower($string)) : ucwords($string);

		foreach (array('-', '\'', '.', ' ') as $delimiter) {
			if (strpos($string, $delimiter)!==false) {
				$string = implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
			}
		}
		$this->value = $string;
		return $this;
	}

	private function capitalizeTitle(string $string, $forceLowerCaseOther = false) {
		$words = explode(' ', $this->capitalizeWords($string, $forceLowerCaseOther));
		for ($i=0;$i<count($words);$i++) {
			if (!$i) continue;
			$word = $words[$i]; $prevword = isset($words[$i-1]) ? $words[$i-1] : null;
			if (in_array(strtolower($word), array('a','in','for','the','of','if','on','to')) && !preg_match('/[\.\:\!\?]$/', $prevword)) {
				$word = strtolower($word);
			}elseif (Num::isRomanNumerals(preg_replace('/[\W]+/', '', strtoupper($word)))) {
				$word = strtoupper($word);
			}
			$words[$i] = $word;
		}
		$this->value = implode(' ', $words);
		return $this;
	}

	private function isRomanNumerals(string $string) {
		return boolval(Num::isRomanNumerals($string));
	}
	
	private function replace(string $subject, string $find, string $replace = null, $ignoreCase = false) {
		$this->value = $ignoreCase ? str_ireplace($find, $replace, $subject) : str_replace($find, $replace, $subject);
		return $this;
	}
	
	private function replaceRegex(string $subject, string $find, string $replace = null) {
		$this->value = preg_replace($find, $replace, $subject);
		return $this;
	}
	
	private function replaceFirst(string $haystack, string $needle, string $replace = null, $ignoreCase = false) {
		$this->value = (($pos = ($ignoreCase ? stripos($haystack, $needle) : strpos($haystack, $needle))) !== false) ? substr_replace($haystack, $replace, $pos, strlen($needle)) : $haystack;
		return $this;
	}
	
	private function replaceLast(string $haystack, string $needle, string $replace = null, $ignoreCase = false) {
		$this->value = (($pos = ($ignoreCase ? strripos($haystack, $needle) : strrpos($haystack, $needle))) !== false) ? substr_replace($haystack, $replace, $pos, strlen($needle)) : $haystack;
		return $this;
	}

	private function suffix(string $string, string $suffix, $ifNotExists = false, $ignoreCase = false) {
		$this->value = $ifNotExists && $this->endsWith($string, $suffix, $ignoreCase) ? $string : $string.$suffix;
		return $this;
	}

	private function prefix(string $string, string $prefix, $ifNotExists = false, $ignoreCase = false) {
		$this->value = $ifNotExists && $this->startsWith($string, $prefix, $ignoreCase) ? $string : $prefix.$string;
		return $this;
	}

	private function replaceSuffix(string $subject, string $find, string $replace = null, $ignoreCase = false) {
		$this->value = $this->endsWith($subject, $find, $ignoreCase) ? (string)$this->replaceLast($subject, $find, $replace, $ignoreCase) : $subject;
		printDie($this->value, false);
		return $this;
	}

	private function replacePrefix(string $subject, string $find, string $replace = null, $ignoreCase = false) {
		$this->value = $this->startsWith($subject, $find, $ignoreCase) ? (string)$this->replaceFirst($subject, $find, $replace, $ignoreCase) : $subject;
		return $this;
	}

	private function betweenGreedy(string $string, string $first, string $last = null, $ignoreCase = false) {
		if ($last===null) $last = $first;
		$this->value = (string)$this->afterFirst((string)$this->beforeLast($string, $last, $ignoreCase), $first, $ignoreCase);
		return $this;
	}

	private function between(string $string, string $first, string $last = null, $ignoreCase = false) {
		if ($last===null) $last = $first;
		$this->value = (string)$this->beforeFirst((string)$this->afterFirst($string, $first, $ignoreCase), $last, $ignoreCase);
		return $this;
	}

	private function betweenLazy(string $string, string $first, string $last = null, $ignoreCase = false) {
		if ($last===null) $last = $first;
		$this->value = (string)$this->afterLast((string)$this->beforeLast($string, $last, $ignoreCase), $first, $ignoreCase);
		return $this;
	}

	private function equals(string $string1, string $string2, $ignoreCase = false) {
		return boolval($ignoreCase ? strtolower($string1)===strtolower($string2) : $string1===$string2);
	}

	private function words(string $string, string $delim = null, $ignoreEmpty = false) {
		$split = !is_null($delim) ? preg_split($delim, $string) : preg_split('/(\s[\W]\s|[\s])/', $string);
		if (!$ignoreEmpty) return $split;
		$return = [];
		foreach ($split as $word) {
			if (strlen($word))
				$return[] = $word;
		}
		return $return;
	}

	private function wordCount(string $string, string $delim = null, $ignoreEmpty = false) {
		return count($this->words($string, $delim, $ignoreEmpty));
	}

	private function characters(string $string) {
		return str_split($string);
	}

	private function length(string $string) {
		return strlen($string);
	}

	private function html(string $string) {
		$this->value = htmlspecialchars($string, ENT_QUOTES);
		return $this;
	}

	private function newline(string $subject, $newline = "\n") {
		$this->value = preg_replace('/\R/u', $newline, $subject);
		return $this;
	}

	private function reverse(string $string) {
		$this->value = strrev($string);
		return $this;
	}

	private function acronym(string $string, $outputCapitalised = false, $ignoreLowerCase = false) {
		$str = '';
		foreach ($this->words($string) as $word) {
			if (!$ignoreLowerCase || ($ignoreLowerCase && $word[0]==strtoupper($word[0])))
				$str.=$word[0];
		}
		$this->value = $outputCapitalised ? strtoupper($str) : $str;
		return $this;
	}

	private function parseDir() {
		$return = '';
		foreach (func_get_args() as $str) {
			if ($str == '' || $str == null || $str == false) continue;
			$return .= '/'.trim($str, '/');
		}
		$this->value = $return;
		return $this;
	}

	private function stripExtension(string $string) {
		$this->value = preg_replace('/\.([a-z0-9]+)$/i', '', $string);
		return $this;
	}

	private function url(string $str) {
		$this->value = trim(strtolower(preg_replace('/[^a-z0-9]+/i', '-', $str)), '-');
		return $this;
	}
}