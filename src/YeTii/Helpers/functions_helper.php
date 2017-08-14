<?php

function printDie($variable = NULL, $die = TRUE) {
	print '<pre style="display:block;">';
	print_r(debug_makevisible($variable));
	print '</pre>';
	if ($die) die('');
}

function debug_makevisible($variable) {
	die(print_r($variable, true));
	if (is_array($variable)||is_object($variable)) {
		foreach ($variable as $key => $value) {
			if ($value===NULL) $variable[$key] = '&lt;NULL&gt;';
			if ($value===FALSE) $variable[$key] = '&lt;FALSE&gt;';
			if ($value===TRUE) $variable[$key] = '&lt;TRUE&gt;';
			if ($value==='') $variable[$key] = '&lt;EMPTY_STRING&gt;';
			if (is_array($value)||is_object($value))
				$variable->{$key} = dd_makevisible($value);
		}
	}elseif (is_object($variable)) {
		foreach ($variable as $key => $value) {
			if ($value===NULL) $variable->{$key} = '&lt;NULL&gt;';
			if ($value===FALSE) $variable->{$key} = '&lt;FALSE&gt;';
			if ($value===TRUE) $variable->{$key} = '&lt;TRUE&gt;';
			if ($value==='') $variable->{$key} = '&lt;EMPTY_STRING&gt;';
			if (is_array($value)||is_object($value))
				$variable->{$key} = dd_makevisible($value);
		}
	}else{
		if ($value===NULL) return '&lt;NULL&gt;';
		if ($value===FALSE) return '&lt;FALSE&gt;';
		if ($value===TRUE) return '&lt;TRUE&gt;';
		if ($value==='') return '&lt;EMPTY_STRING&gt;';
	}
	return $variable;
}
