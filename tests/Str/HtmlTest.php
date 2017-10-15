<?php

use PHPUnit\Framework\TestCase;
use YeTii\General\Str;

/**
 * Class HtmlTest
 */
class HtmlTest extends TestCase
{
    /**
     * @var string
     */
    public $testString = 'The quick brown fox jumps over the lazy dog, <i>Snowball</i>';

    /**
     * Test whether it returns an array of the words
     */
    public function testHtml()
    {
        $str = new Str($this->testString);
        $result = $str->html();
        $this->assertTrue($result->value === htmlspecialchars($this->testString));
    }
}