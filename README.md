# libraries
Collection of classes/libs



## YeTii\General\Str
A String class with built-in helpful functions.
Hint: The Str class can be directly printed as a string to print its string value (`echo $str`)

```php
$str = new Str('This is a test');
$str->contains($needle, $ignoreCase = false); // does the haystack contain an instance of $needle?
$str->indexFirst($needle, $ignoreCase = false); // get index of the first occurance of $needle
$str->indexLast($needle, $ignoreCase = false); // get index of the last occurance of $needle
$str->startsWith($needle, $ignoreCase = false); // does the string start with $needle?
$str->endsWith($needle, $ignoreCase = false); // does the string end with $needle?
$str->afterLast($needle, $ignoreCase = false); // get string AFTER the LAST occurance of $needle
$str->afterFirst($needle, $ignoreCase = false); // get string AFTER the FIRST occurance of $needle
$str->beforeLast($needle, $ignoreCase = false); // get string BEFORE the LAST occurance of $needle
$str->beforeFirst($needle, $ignoreCase = false); // get string BEFORE the FIRST occurance of $needle
$str->first($length); // grab the first $length characters
$str->last($length); // grab the last $length characters
$str->isLowerCase(); // is the string all lowercase?
$str->isUpperCase(); // is the string all uppercase?
$str->toLowerCase(); // convert string to lowercase
$str->toUpperCase(); // convert string to uppercase
$str->isCapitalized(); // Check if first letter of string is capitalized
$str->isCapitalizedWords($forceLowerCaseOther = false); // Check if each word is capitalized (Check all following letters are lowercase -- e.g. not all CAPS)
$str->capitalizeWords(); // capitalizes each word in the string.
$str->capitalizeTitle(); // capitalizes each word in the string except 'a', 'in', 'the', and more. Also capitalizes Roman Numerals
$str->isRomanNumerals(); // checks if string is roman numerals (case insensitive)
$str->replace($find, $replace, $ignoreCase = false); // replaces $find with $replace
$str->replaceRegex($regex, $replace); // $regex is full regex string "/like-so/i"
$str->replaceFirst($find, $replace, $ignoreCase = false); // replaces FIRST instance of $find with $replace 
$str->replaceLast(); // replaces LAST instance of $find with $replace
$str->suffix($suffix, $ifNotExists = false, $ignoreCase = false); // add suffix to string. If suffix exists and $ifNotExist==true, it won't append.
$str->prefix();  // add prefix to string. If prefix exists and $ifNotExist==true, it won't prepend.
$str->replaceSuffix($find, $replace, $ignoreCase = false); // find/replace suffix if string ends with $find
$str->replacePrefix($find, $replace, $ignoreCase = false); // find/replace prefix if string starts with $find
$str->between($first, $last, $ignoreCase = false); // substring between FIRST $first and FIRST $last delims.
$str->betweenGreedy($first, $last, $ignoreCase = false); // Same as between() however between FIRST $first and LAST $last
$str->betweenLazy($first, $last, $ignoreCase = false); // Same as between() however between LAST $first and LAST $last
$str->equals($string, $ignoreCase = false); // does the $string match?
$str->words($delim = null, $ignoreEmpty = false); // return an array of words (delimitered by '/(\s[\W]\s|[\s])/').. overridden by $delim
$str->wordCount($delim = null, $ignoreEmpty = false); // get count of words from words()
$str->characters(); // return an array of characters in string
$str->length(); // return length of string
$str->html(); // return htmlspecialchars version of string
$str->newline($newline = "\n"); // normalize newlines to $newline
$str->reverse(); // return reversed string
$str->acronym($outputCapitalised = false, $ignoreLowerCase = false); // return acronym of string ('Laugh out loud' would be 'Lol'). Capitalised output: 'LOL' and ignore-lowercase: 'L'
$str->parseDir($path [, $...]); // concatenate all args (or array arg) into valid directory string delimitered by single slash
$str->stripExtension(); // Remove extension ('Readme.txt' would be 'Readme')
$str->url(); // Make url-friendly version of the string (lowercase + only A-Z and 0-9 and hyphens for spaces)


// You can also use Str class statically (MUST pass source string variable before other args)
Str::contains($haystack, $needle); // notice the difference? $str->contains($needle);
Str::html($haystack); // and $str->html();
Str::replace($haystack, $find, $replace, $ignoreCase); // and $str->replace($find, $replace, $ignoreCase);
```
