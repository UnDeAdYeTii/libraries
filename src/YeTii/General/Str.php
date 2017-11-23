<?php

namespace YeTii\General;

/**
 * Class Str
 */
class Str
{
    /**
     * @var string
     */
    public $value;

    /**
     * Str constructor.
     * @param null $str
     */
    public function __construct($str = null)
    {
        if (!is_null($str)) {
            $this->value = (string)$str;
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            array_unshift($arguments, $this->value);

            $s = new Str($this->value);
            return call_user_func_array([
                $s,
                $name
            ], $arguments);
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $s = new Str();

        return call_user_func_array([$s, $name], $arguments);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->value;
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @param bool   $ignoreCase
     * @return bool
     */
    private function contains(string $haystack, string $needle, $ignoreCase = false)
    {
        return boolval($ignoreCase ? substr_count(strtolower($haystack), strtolower($needle)) : substr_count($haystack, $needle));
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @param bool   $ignoreCase
     * @return bool|int
     */
    private function indexFirst(string $haystack, string $needle, $ignoreCase = false)
    {
        return $ignoreCase ? stripos($haystack, $needle) : strpos($haystack, $needle);
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @param bool   $ignoreCase
     * @return bool|int
     */
    private function indexLast(string $haystack, string $needle, $ignoreCase = false)
    {
        return $ignoreCase ? strripos($haystack, $needle) : strrpos($haystack, $needle);
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @param bool   $ignoreCase
     * @return bool
     */
    private function startsWith(string $haystack, string $needle, $ignoreCase = false)
    {
        return boolval($needle === ""
                       || ($ignoreCase ? strripos($haystack, $needle, -strlen($haystack)) : strrpos($haystack, $needle,
                -strlen($haystack))) !== false);
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @param bool   $ignoreCase
     * @return bool
     */
    private function endsWith(string $haystack, string $needle, $ignoreCase = false)
    {
        return boolval($needle === ""
                       || (($temp = strlen($haystack) - strlen($needle)) >= 0
                           && ($ignoreCase ? stripos($haystack, $needle, $temp) : strpos($haystack, $needle, $temp)) !== false));
    }

    /**
     * @param string $string
     * @param string $delimiter
     * @param bool   $ignoreCase
     * @return $this
     */
    private function afterLast(string $string, string $delimiter, $ignoreCase = false)
    {
        $pos = $this->indexLast($string, $delimiter, $ignoreCase);
        $this->value = $pos ? substr($string, $pos + 1) : $string;

        return $this;
    }

    /**
     * @param string $string
     * @param string $delimiter
     * @param bool   $ignoreCase
     * @return $this
     */
    private function beforeLast(string $string, string $delimiter, $ignoreCase = false)
    {
        $this->value = substr($string, 0, ($ignoreCase ? strripos($string, $delimiter) : strrpos($string, $delimiter)));

        return $this;
    }

    /**
     * @param string $string
     * @param string $delimiter
     * @param bool   $ignoreCase
     * @return $this
     */
    private function afterFirst(string $string, string $delimiter, $ignoreCase = false)
    {
        $pos = $this->indexFirst($string, $delimiter, $ignoreCase);
        $this->value = $pos ? substr($string, $pos + 1) : '';

        return $this;
    }

    /**
     * @param string $string
     * @param string $delimiter
     * @param bool   $ignoreCase
     * @return $this
     */
    private function beforeFirst(string $string, string $delimiter, $ignoreCase = false)
    {
        $this->value = substr($string, 0, $this->indexFirst($string, $delimiter, $ignoreCase));

        return $this;
    }

    /**
     * @param string $string
     * @param int    $length
     * @return $this
     */
    private function first(string $string, int $length)
    {
        $this->value = strlen($string) < $length ? $string : substr($string, 0, $length);

        return $this;
    }

    /**
     * @param string $string
     * @param int    $length
     * @return $this
     */
    private function last(string $string, int $length)
    {
        $this->value = strlen($string) < $length ? $string : substr($string, -$length);

        return $this;
    }

    /**
     * @param string $string
     * @return bool
     */
    private function isLowerCase(string $string)
    {
        return boolval($string === strtolower($string));
    }

    /**
     * @param string $string
     * @return bool
     */
    private function isUpperCase(string $string)
    {
        return boolval($string === strtoupper($string));
    }

    /**
     * @param string $string
     * @return $this
     */
    private function toLowerCase(string $string)
    {
        $this->value = strtolower($string);

        return $this;
    }

    /**
     * @param string $string
     * @return $this
     */
    private function toUpperCase(string $string)
    {
        $this->value = strtoupper($string);

        return $this;
    }

    /**
     * @param string $string
     * @return bool
     */
    private function isCapitalized(string $string)
    {
        return boolval(strlen($string) ? $string[0] == strtoupper($string[0]) : false);
    }

    /**
     * @param string $string
     * @param bool   $forceLowerCaseOther
     * @return bool
     */
    private function isCapitalizedWords(string $string, $forceLowerCaseOther = false)
    {
        return boolval($string == strval($this->capitalizeWords($string, $forceLowerCaseOther)));
    }

    /**
     * @param string $string
     * @param bool   $forceLowerCaseOther
     * @return $this
     */
    private function capitalizeWords(string $string, $forceLowerCaseOther = false)
    {
        $string = $forceLowerCaseOther ? ucwords(strtolower($string)) : ucwords($string);

        foreach (['-', '\'', '.', ' '] as $delimiter) {
            if (strpos($string, $delimiter) !== false) {
                $string = implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
            }
        }
        $this->value = $string;

        return $this;
    }

    /**
     * @param string $string
     * @param bool   $forceLowerCaseOther
     * @return $this
     */
    private function capitalizeTitle(string $string, $forceLowerCaseOther = false)
    {
        $words = explode(' ', $this->capitalizeWords($string, $forceLowerCaseOther));
        for ($i = 0; $i < count($words); $i++) {
            if (!$i) {
                continue;
            }
            $word = $words[$i];
            $prevword = isset($words[$i - 1]) ? $words[$i - 1] : null;
            if (in_array(strtolower($word), ['a', 'in', 'for', 'the', 'of', 'if', 'on', 'to'])
                && !preg_match('/[\.\:\!\?]$/', $prevword)) {
                $word = strtolower($word);
            } elseif (Num::isRomanNumerals(preg_replace('/[\W]+/', '', strtoupper($word)))) {
                $word = strtoupper($word);
            }
            $words[$i] = $word;
        }
        $this->value = implode(' ', $words);

        return $this;
    }

    /**
     * @param string $string
     * @return bool
     */
    private function isRomanNumerals(string $string)
    {
        return boolval(Num::isRomanNumerals($string));
    }

    /**
     * @param string      $subject
     * @param string      $find
     * @param string|null $replace
     * @param bool        $ignoreCase
     * @return $this
     */
    private function replace(string $subject, string $find, string $replace = null, $ignoreCase = false)
    {
        $this->value = $ignoreCase ? str_ireplace($find, $replace, $subject) : str_replace($find, $replace, $subject);

        return $this;
    }

    /**
     * @param string      $subject
     * @param string      $find
     * @param string|null $replace
     * @return $this
     */
    private function replaceRegex(string $subject, string $find, string $replace = null)
    {
        $this->value = preg_replace($find, $replace, $subject);

        return $this;
    }

    /**
     * @param string      $haystack
     * @param string      $needle
     * @param string|null $replace
     * @param bool        $ignoreCase
     * @return $this
     */
    private function replaceFirst(string $haystack, string $needle, string $replace = null, $ignoreCase = false)
    {
        $this->value = (($pos = ($ignoreCase ? stripos($haystack, $needle) : strpos($haystack, $needle)))
                        !== false) ? substr_replace($haystack, $replace, $pos, strlen($needle)) : $haystack;

        return $this;
    }

    /**
     * @param string      $haystack
     * @param string      $needle
     * @param string|null $replace
     * @param bool        $ignoreCase
     * @return $this
     */
    private function replaceLast(string $haystack, string $needle, string $replace = null, $ignoreCase = false)
    {
        $this->value = (($pos = ($ignoreCase ? strripos($haystack, $needle) : strrpos($haystack, $needle)))
                        !== false) ? substr_replace($haystack, $replace, $pos, strlen($needle)) : $haystack;

        return $this;
    }

    /**
     * @param string $string
     * @param string $suffix
     * @param bool   $ifNotExists
     * @param bool   $ignoreCase
     * @return $this
     */
    private function suffix(string $string, string $suffix, $ifNotExists = false, $ignoreCase = false)
    {
        $this->value = $ifNotExists && $this->endsWith($string, $suffix, $ignoreCase) ? $string : $string . $suffix;

        return $this;
    }

    /**
     * @param string $string
     * @param string $prefix
     * @param bool   $ifNotExists
     * @param bool   $ignoreCase
     * @return $this
     */
    private function prefix(string $string, string $prefix, $ifNotExists = false, $ignoreCase = false)
    {
        $this->value = $ifNotExists && $this->startsWith($string, $prefix, $ignoreCase) ? $string : $prefix . $string;

        return $this;
    }

    /**
     * @param string      $subject
     * @param string      $find
     * @param string|null $replace
     * @param bool        $ignoreCase
     * @return $this
     */
    private function replaceSuffix(string $subject, string $find, string $replace = null, $ignoreCase = false)
    {
        $this->value = $this->endsWith($subject, $find, $ignoreCase) ? (string)$this->replaceLast($subject, $find, $replace,
            $ignoreCase) : $subject;

        return $this;
    }

    /**
     * @param string      $subject
     * @param string      $find
     * @param string|null $replace
     * @param bool        $ignoreCase
     * @return $this
     */
    private function replacePrefix(string $subject, string $find, string $replace = null, $ignoreCase = false)
    {
        $this->value = $this->startsWith($subject, $find, $ignoreCase) ? (string)$this->replaceFirst($subject, $find, $replace,
            $ignoreCase) : $subject;

        return $this;
    }

    /**
     * @param string      $string
     * @param string      $first
     * @param string|null $last
     * @param bool        $ignoreCase
     * @return $this
     */
    private function betweenGreedy(string $string, string $first, string $last = null, $ignoreCase = false)
    {
        if ($last === null) {
            $last = $first;
        }
        $this->value = (string)$this->afterFirst((string)$this->beforeLast($string, $last, $ignoreCase), $first, $ignoreCase);

        return $this;
    }

    /**
     * @param string      $string
     * @param string      $first
     * @param string|null $last
     * @param bool        $ignoreCase
     * @return $this
     */
    private function between(string $string, string $first, string $last = null, $ignoreCase = false)
    {
        if ($last === null) {
            $last = $first;
        }
        $this->value = (string)$this->beforeFirst((string)$this->afterFirst($string, $first, $ignoreCase), $last, $ignoreCase);

        return $this;
    }

    /**
     * @param string      $string
     * @param string      $first
     * @param string|null $last
     * @param bool        $ignoreCase
     * @return $this
     */
    private function betweenLazy(string $string, string $first, string $last = null, $ignoreCase = false)
    {
        if ($last === null) {
            $last = $first;
        }
        $this->value = (string)$this->afterLast((string)$this->beforeLast($string, $last, $ignoreCase), $first, $ignoreCase);

        return $this;
    }

    /**
     * @param string $string1
     * @param string $string2
     * @param bool   $ignoreCase
     * @return bool
     */
    private function equals(string $string1, string $string2, $ignoreCase = false)
    {
        return boolval($ignoreCase ? strtolower($string1) === strtolower($string2) : $string1 === $string2);
    }

    /**
     * @param string      $string
     * @param string|null $delim
     * @param bool        $ignoreEmpty
     * @return array|false|string[]
     */
    private function words(string $string, string $delim = null, $ignoreEmpty = false)
    {
        $split = !is_null($delim) ? preg_split($delim, $string) : preg_split('/(\s[\W]\s|[\s])/', $string);
        if (!$ignoreEmpty) {
            return $split;
        }
        $return = [];
        foreach ($split as $word) {
            if (strlen($word)) {
                $return[] = $word;
            }
        }

        return $return;
    }

    /**
     * @param string      $string
     * @param string|null $delim
     * @param bool        $ignoreEmpty
     * @return int
     */
    private function wordCount(string $string, string $delim = null, $ignoreEmpty = false)
    {
        return count($this->words($string, $delim, $ignoreEmpty));
    }

    /**
     * @param string $string
     * @return array
     */
    private function characters(string $string)
    {
        return str_split($string);
    }

    /**
     * @param string $string
     * @return int
     */
    private function length(string $string)
    {
        return strlen($string);
    }

    /**
     * @param string $string
     * @return $this
     */
    private function html(string $string)
    {
        $this->value = htmlspecialchars($string, ENT_QUOTES);

        return $this;
    }

    /**
     * @param string $subject
     * @param string $newline
     * @return $this
     */
    private function newline(string $subject, $newline = "\n")
    {
        $this->value = preg_replace('/\R/u', $newline, $subject);

        return $this;
    }

    /**
     * @param string $string
     * @return $this
     */
    private function reverse(string $string)
    {
        $this->value = strrev($string);

        return $this;
    }

    /**
     * @param string $string
     * @param bool   $outputCapitalised
     * @param bool   $ignoreLowerCase
     * @return $this
     */
    private function acronym(string $string, $outputCapitalised = false, $ignoreLowerCase = false)
    {
        $str = '';
        foreach ($this->words($string) as $word) {
            if (!$ignoreLowerCase || ($ignoreLowerCase && $word[0] == strtoupper($word[0]))) {
                $str .= $word[0];
            }
        }
        $this->value = $outputCapitalised ? strtoupper($str) : $str;

        return $this;
    }

    /**
     * @return $this
     */
    private function parseDir()
    {
        $return = '';
        foreach (func_get_args() as $str) {
            if ($str == '' || $str == null || $str == false) {
                continue;
            }
            $return .= '/' . trim($str, '/');
        }
        $this->value = $return;

        return $this;
    }

    /**
     * @param string $string
     * @return $this
     */
    private function stripExtension(string $string)
    {
        $this->value = preg_replace('/\.([a-z0-9]+)$/i', '', $string);

        return $this;
    }

    /**
     * @param string $string
     * @return $this
     */
    private function hasExtension(string $string)
    {
        return boolval(preg_match('/\.([a-z0-9]+)$/i', $string));
    }

    /**
     * @param string $string
     * @param mixed $default
     * @return $this
     */
    private function getExtension(string $string, $default = null)
    {
        preg_match('/\.([a-z0-9]+)$/i', $string, $m);
        return isset($m[1]) ? $m[1] : $default;
    }

    /**
     * @param string $string
     * @return $this
     */
    private function url(string $string)
    {
        $this->value = trim(strtolower(preg_replace('/[^a-z0-9]+/i', '-', $str)), '-');

        return $this;
    }

    /**
     * @param string $string
     * @return $this
     */
    private function camelCase(string $string) {
        $string = preg_replace('/(?<!\ )(?<![A-Z])[A-Z]/', ' $0', $string);
        $words = $this->words($string, '/\W|_/', true);

        $words = array_map('strtolower', $words);

        $words = array_map('ucfirst', $words);
        $this->value = lcfirst(implode('', $words));

        return $this;
    }

    /**
     * @param string $string
     * @return $this
     */
    private function pascalCase(string $string) {
        $this->value = ucfirst($this->camelCase($string));

        return $this;
    }

    /**
     * @param string $string
     * @return $this
     */
    private function snakeCase(string $string) {
        $string = preg_replace('/(?<!\ )(?<![A-Z])[A-Z]/', ' $0', $string);
        $words = $this->words($string, '/\W/', true);
        $this->value = strtolower(implode('_', $words));

        return $this;
    }

    /**
     * @param string $string
     * @return bool
     */
    private function isCamelCase(string $string) {
        return $string==$this->camelCase($string);
    }

    /**
     * @param string $string
     * @return bool
     */
    private function isPascalCase(string $string) {
        return $string==$this->pascalCase($string);
    }

    /**
     * @param string $string
     * @return bool
     */
    private function isSnakeCase(string $string) {
        return $string==$this->snakeCase($string);
    }
}