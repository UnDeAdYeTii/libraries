<?php
namespace YeTii\General;

use YeTii\General\Arr;
use YeTii\General\Num;
use YeTii\General\Str;

class Var {

	public $value;

	private function objectify($var) {
		switch (gettype($var)) {
			case 'string':
				return new Str($var);
			case 'integer':
				return new Num($var);
			case 'array':
				return new Arr($var);
		}
		return $var;
	}

}