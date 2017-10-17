<?php

namespace YeTii\General;

class Arr
{
    public $value;

    public function __construct()
    {
        $arr = [];
        if (func_num_args() == 1 && is_array(func_get_arg(0))) {
            $arr = func_get_arg(0);
        } else {
            foreach (func_get_args() as $part) {
                $arr[] = $part;
            }
        }
        $this->value = $arr;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            array_unshift($arguments, $this->value);

            return call_user_func_array([$this, $name], $arguments);
        }
    }

    public static function __callStatic($name, $arguments)
    {
        $s = new YeTii\General\Arr();

        return call_user_func_array([$s, $name], $arguments);
    }

    public function __toString()
    {
        return json_encode($this->value);
    }

    public function toArray()
    {
        return $this->value;
    }

    public function toObject()
    {
        return (object)$this->value;
    }

    private function indexOf(array $haystack, $needle, $default = null)
    {
        $index = array_search($needle, $haystack);

        return $index ? $index : $default;
    }

    private function indexesOf(array $haystack, $needle, $default = [])
    {
        $indexes = [];
        foreach ($haystack as $index => $straw) {
            if ($straw === $needle) {
                $indexes[] = $index;
            }
        }

        return $indexes ? $indexes : $default;
    }

    private function at(array $haystack, $index, $default = null)
    {
        return isset($haystack[$index]) ? $haystack[$index] : $default;
    }

    private function get(array $array, $key, $default = null, $delim = '.')
    {
        $keys = explode($delim, $key);
        $tmp = &$array;
        foreach ($keys as $k) {
            if (isset($tmp[$k])) {
                $tmp = $tmp[$k];
            } else {
                return $default;
            }
        }

        return $tmp;
    }

    private function set(array $array, $key, $value = null, $delim = '.')
    {
        $keys = explode($delim, $key);
        $tmp = &$array;
        foreach ($keys as $k) {
            if (isset($tmp[$k])) {
                $tmp = &$tmp[$k];
            } else {
                $tmp[$k] = [];
            }
        }
        $tmp = $value;
        printDie($array);
        $this->value = $array;

        return $this;
    }

    private function extend()
    {
        $arrays = func_get_args();
        $base = array_shift($arrays);
        foreach ($arrays as $array) {
            if (is_object($array) && get_class($array) == 'YeTii\General\Arr') {
                $array = $array->toArray();
            }
            reset($base);
            while (list($key, $value) = @each($array)) {
                $base[$key] = is_array($value) && @is_array($base[$key]) ? $this->extend($base[$key],
                    $value) : $base[$key] = $value;
            }
        }

        return $base;
    }

    private function merge()
    {
        $arr = call_user_func_array([$this, 'extend'], func_get_args());
        $this->value = $arr;

        return $this;
    }

    private function shuffle(array $array)
    {
        shuffle($array);
        $this->value = $array;

        return $this;
    }

    private function length(array $array)
    {
        return count($array);
    }

    private function keys(array $array)
    {
        return array_keys($array);
    }

    private function values(array $array)
    {
        return array_values($array);
    }

    private function map(array $array, $function)
    {
        return array_map($function, $array);
    }

    private function append(array $array, $add)
    {
        array_push($array, $add);
        $this->value = $array;

        return $this;
    }

    private function prepend(array $array, $add)
    {
        array_unshift($array, $add);
        $this->value = $array;

        return $this;
    }

    private function last(array $array, int $length = 1)
    {
        if (!$length) {
            return false;
        }
        if ($length >= $this->length($array)) {
            return $array;
        }
        $arr = [];
        for ($i = 0; $i < $length; $i++) {
            $arr[] = array_pop($array);
        }
        $this->value = $array;

        return $arr;
    }

    private function first(array $array, int $length = 1)
    {
        if (!$length) {
            return false;
        }
        if ($length >= $this->length($array)) {
            return $array;
        }
        $arr = [];
        for ($i = 0; $i < $length; $i++) {
            $arr[] = array_shift($array);
        }
        $this->value = $array;

        return $arr;
    }
}