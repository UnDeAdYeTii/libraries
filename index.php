<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
set_time_limit(0);

require_once __DIR__ . '/vendor/autoload.php';
use YeTii\General\Str;
use YeTii\General\Num;
use YeTii\General\Arr;
use YeTii\Applications\Curl;
use YeTii\Applications\Ffmpeg;

function printDie($var, $die = true) {
	print '<pre>'.htmlspecialchars(print_r($var, true));
	if ($die) die();
}

function printOut($val) {
	print '<p>printed: '.$val;
}


$ffmpeg = new Ffmpeg();
printDie($ffmpeg);

die("end");


// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->contains('fox'): ".$str->contains('fox');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->contains('FOX'): ".$str->contains('FOX');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->contains('FOX', true): ".$str->contains('FOX', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->indexFirst('t'): ".$str->indexFirst('t');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->indexFirst('T'): ".$str->indexFirst('T');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->indexFirst('t', true): ".$str->indexFirst('t', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->indexLast('t'): ".$str->indexLast('t');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->indexLast('T'): ".$str->indexLast('T');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->indexLast('T', true): ".$str->indexLast('T', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->startsWith('the'): ".$str->startsWith('the');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->startsWith('The'): ".$str->startsWith('The');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->startsWith('the', true): ".$str->startsWith('the', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->endsWith('snowball'): ".$str->endsWith('snowball');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->endsWith('Snowball'): ".$str->endsWith('Snowball');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->endsWith('snowball', true): ".$str->endsWith('snowball', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->afterLast('s'): ".$str->afterLast('s');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->afterLast('S'): ".$str->afterLast('S');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->afterLast('s', true): ".$str->afterLast('s', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->beforeLast('s'): ".$str->beforeLast('s');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->beforeLast('S'): ".$str->beforeLast('S');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->beforeLast('s', true): ".$str->beforeLast('s', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->afterFirst('s'): ".$str->afterFirst('s');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->afterFirst('S'): ".$str->afterFirst('S');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->afterFirst('s', true): ".$str->afterFirst('s', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->beforeFirst('s'): ".$str->beforeFirst('s');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->beforeFirst('S'): ".$str->beforeFirst('S');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->beforeFirst('s', true): ".$str->beforeFirst('s', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->first(7): ".$str->first(7);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->last(7): ".$str->last(7);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->isLowerCase(): ".$str->isLowerCase();



// $str = new Str('the quick brown fox jumps over the lazy dog, snowball');
// print "<p>\$str->isLowerCase(): ".$str->isLowerCase();



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->isUpperCase(): ".$str->isUpperCase();



// $str = new Str('THE QUICK BROWN FOX JUMPS OVER THE LAZY DOG, SNOWBALL');
// print "<p>\$str->isUpperCase(): ".$str->isUpperCase();



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->toLowerCase(): ".$str->toLowerCase();



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->toUpperCase(): ".$str->toUpperCase();



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->isCapitalized(): ".$str->isCapitalized();



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->isCapitalizedWords(): ".$str->isCapitalizedWords();



// $str = new Str('The Quick Brown Fox Jumps Over The Lazy Dog, Snowball');
// print "<p>\$str->isCapitalizedWords(): ".$str->isCapitalizedWords();



// $str = new Str('The Quick Brown Fox Jumps Over The Lazy Dog, Snowball');
// print "<p>\$str->isCapitalizedWords(): ".$str->isCapitalizedWords(true);



// $str = new Str('The Quick Brown Fox Jumps Over The Lazy Dog, SNOWBALL');
// print "<p>\$str->isCapitalizedWords(): ".$str->isCapitalizedWords(true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->capitalizeWords(): ".$str->capitalizeWords();



// $str = new Str('The quick brown fox jumps over the lazy DOG, Snowball');
// print "<p>\$str->capitalizeWords(): ".$str->capitalizeWords(true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->capitalizeTitle(): ".$str->capitalizeTitle();



// $str = new Str('The quick brown fox jumps over the lazy DOG, Snowball');
// print "<p>\$str->capitalizeWords(): ".$str->capitalizeTitle(true);



// $str = new Str('XIV');
// print "<p>\$str->isRomanNumerals(): ".$str->isRomanNumerals();



// $str = new Str('IXIV');
// print "<p>\$str->isRomanNumerals(): ".$str->isRomanNumerals();



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replace('Snowball', 'Snuffles'): ".$str->replace('Snowball', 'Snuffles');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replace('snowball', 'Snuffles'): ".$str->replace('snowball', 'Snuffles');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replace('snowball', 'Snuffles', true): ".$str->replace('snowball', 'Snuffles', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replaceRegex('([A-Z][a-z]+): ".$str->replaceRegex('([A-Z][a-z]+)', 'Word');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replaceRegex('([a-z][a-z]+): ".$str->replaceRegex('([a-z][a-z]+)', 'word');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replaceRegex('([A-Z][a-z]+): ".$str->replaceRegex('([A-Z][a-z]+)', 'Word', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replaceFirst('the', 'a'): ".$str->replaceFirst('the', 'a');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replaceFirst('The', 'A'): ".$str->replaceFirst('The', 'A');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replaceFirst('the', 'a', true): ".$str->replaceFirst('the', 'a', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replaceLast('The', 'A'): ".$str->replaceLast('The', 'A');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replaceLast('the', 'a'): ".$str->replaceLast('the', 'a');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replaceLast('The', 'A', true): ".$str->replaceLast('The', 'A', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->suffix(', snowball'): ".$str->suffix(', snowball');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->suffix(', snowball', true): ".$str->suffix(', snowball', true);
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->suffix(', snowball', false, true): ".$str->suffix(', snowball', false, true);
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->suffix(', snowball', true, true): ".$str->suffix(', snowball', true, true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->prefix('the '): ".$str->prefix('the ');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->prefix('the ', true): ".$str->prefix('the ', true);
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->prefix('the ', false, true): ".$str->prefix('the ', false, true);
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->prefix('the ', true, true): ".$str->prefix('the ', true, true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replaceSuffix('snowball', 'snuffles'): ".$str->replaceSuffix('snowball', 'snuffles');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replaceSuffix('Snowball', 'Snuffles'): ".$str->replaceSuffix('Snowball', 'Snuffles');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replaceSuffix('snowball', 'Snuffles', true): ".$str->replaceSuffix('snowball', 'Snuffles', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replacePrefix('the', 'a'): ".$str->replacePrefix('the', 'a');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replacePrefix('The', 'A'): ".$str->replacePrefix('The', 'A');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->replacePrefix('the', 'A', true): ".$str->replacePrefix('the', 'A', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->betweenGreedy('e', 's'): ".$str->betweenGreedy('e', 's');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->betweenGreedy('e', 'S'): ".$str->betweenGreedy('e', 'S');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->betweenGreedy('e', 's', true): ".$str->betweenGreedy('e', 's', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->between('e', 's'): ".$str->between('e', 's');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->between('e', 'S'): ".$str->between('e', 'S');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->between('e', 's', true): ".$str->between('e', 's', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->betweenLazy('e', 's'): ".$str->betweenLazy('e', 's');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->betweenLazy('e', 'S'): ".$str->betweenLazy('e', 'S');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->betweenLazy('e', 's', true): ".$str->betweenLazy('e', 's', true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->equals('The quick brown fox jumps over the lazy dog, Snowball'): ".$str->equals('The quick brown fox jumps over the lazy dog, Snowball');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->equals('THE quick brown fox jumps over the lazy dog, SNOWBALL'): ".$str->equals('THE quick brown fox jumps over the lazy dog, SNOWBALL');
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->equals('THE quick brown fox jumps over the lazy dog, SNOWBALL', true): ".$str->equals('THE quick brown fox jumps over the lazy dog, SNOWBALL', true);



// $str = new Str('The quick  brown fox jumps over the lazy  dog, Snowball');
// print '<p>'.print_r($str->words(),        true);
// $str = new Str('The quick  brown fox jumps over the lazy  dog, Snowball');
// print '<p>'.print_r($str->words('o'),        true);
// $str = new Str('The quick  brown fox jumps over the lazy  dog, Snowball');
// print '<p>'.print_r($str->words(null, true),        true);
// $str = new Str('The quick  brown fox jumps over the lazy  dog, Snowball');
// print '<p>'.print_r($str->words('o', true),        true);


// $str = new Str('The quick  brown fox jumps over the lazy  dog, Snowball');
// print "<p>\$str->wordCount(): ".$str->wordCount();
// $str = new Str('The quick  brown fox jumps over the lazy  dog, Snowball');
// print "<p>\$str->wordCount(): ".$str->wordCount(null, true);



// $str = new Str('The quick  brown fox jumps over the lazy  dog, Snowball');
// print "<p>\$str->characters(): ".print_r($str->characters(), true);


// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->length(): ".$str->length();



// $str = new Str('The quick brown fox jumps over the lazy dog, <i>Snowball</i>');
// print "<p>\$str->html(): ".$str->html();



// $str = new Str('The quick brown fox jumps over the lazy dog,'."\r".'Snowball');
// print "<p>\$str->newline(): ".$str->newline();


// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->reverse(): ".$str->reverse();



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->acronym(): ".$str->acronym();
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->acronym(true): ".$str->acronym(true);
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->acronym(false, true): ".$str->acronym(false, true);
// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->acronym(true, true): ".$str->acronym(true, true);



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball.txt');
// print "<p>\$str->stripExtension(): ".$str->stripExtension();



// $str = new Str('The quick brown fox jumps over the lazy dog, Snowball');
// print "<p>\$str->url(): ".$str->url();
