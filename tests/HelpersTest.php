<?php

namespace FinderTests;

if(!defined('MONEY_ROUNDING')) { define('MONEY_ROUNDING', 'UP'); }

class HelpersTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;
    public function setUp()
    {
        $this->helper = new \Finder\Helpers();
    }

    public function testSingleMonth()
    {
        $this->assertEquals("1 month", $this->helper->months(1));
    }

    public function testMultipleMonth()
    {
        $this->assertEquals("5 months", $this->helper->months(5));
    }

    public function testInvalidMonths()
    {
        $this->assertEquals("", $this->helper->months('abds'));
    }

    public function testYesNoInvalid()
    {
        $this->assertEquals("", $this->helper->yesNo('hasd'));
    }

    public function testYesNoYes()
    {
        $this->assertEquals("Yes", $this->helper->yesNo(1));
        $this->assertEquals("Yes", $this->helper->yesNo("yes"));
    }

    public function testYesNoNo()
    {
        $this->assertEquals("No", $this->helper->yesNo(0));
        $this->assertEquals("No", $this->helper->yesNo("no"));
    }

    public function testMoneyNoDecimals()
    {
        $this->assertEquals("$10", $this->helper->money(10));
    }

    public function testMoneyDecimals()
    {
        $this->assertEquals("$10.50", $this->helper->money(10.5));
    }

    public function testMoneyRounding()
    {
        // $10.5193 if rounded up which is usually the standard way of rounding should be 10.52 

        $this->helper->money_rounding = ROUND_DOWN;
        $this->assertEquals("$10.51", $this->helper->money(10.5193, 2));

        $this->helper->money_rounding = ROUND_UP;
        $this->assertEquals("$10.52", $this->helper->money(10.5193, 2)); 
    }

    public function testDateOnlyDateNoFormat()
    {
        $this->assertEquals("2015-04-29 12:00:00", $this->helper->date('2015-04-29'));
    }

    public function testDateDateFormat()
    {
        $this->assertEquals("29 04 2015", $this->helper->date('2015-04-29', 'd m Y'));
    }

    public function testDateDateTimeFormat()
    {
        // changed format to H:i d m Y instead of h:i d m Y to give 24 hours
        $this->assertEquals("14:02 29 04 2015", $this->helper->date('2015-04-29 14:02:31', 'H:i d m Y'));
    }

    public function testDateWithTimezone()
    {
        // Asia/Manila = UTC+8
        // Australia/Sydney = UTC+10 (local timezone)
        //
        // this test set the datetime at local datetime at 2015-04-29 14:02:31
        // and returns the datetime at Asia/Manila datetime 12:02 29 04 2015

        $this->assertEquals("12:02 29 04 2015", $this->helper->date('2015-04-29 14:02:31', 'H:i d m Y', 'Asia/Manila'));
    }

    public function testCurrencyFormatterUSD()
    {
        $this->assertEquals("$50.00", $this->helper->currency(50, 'USD'));
    }

    public function testCurrencyFormatterEUR()
    {
        $this->assertEquals("€50.00", $this->helper->currency(50, 'EUR'));
    }

    public function testCurrencyFormatterGBP()
    {
        $this->assertEquals("£50.00", $this->helper->currency(50, 'GBP'));
    }

    public function testCurrencyFormatterRounding()
    {
        $this->assertEquals("$50.64", $this->helper->currency(50.638, 'USD'));
    }

    public function testCurrencyFormatterFormat()
    {
        $this->assertEquals("$50,250.00", $this->helper->currency(50250, 'USD'));
    }

    public function testListOneElement()
    {
        // list is a keyword so renamed function to listSentence
        $this->assertEquals("orange", $this->helper->listSentence(['orange']));
    }

    public function testListTwoElements()
    {
        // list is a keyword so renamed function to listSentence
        $this->assertEquals("orange and green", $this->helper->listSentence(['orange', 'green']));
    }

    public function testListSeveralElements()
    {
        // list is a keyword so renamed function to listSentence
        $this->assertEquals("orange, red, yellow and green", $this->helper->listSentence(['orange', 'red', 'yellow', 'green']));
    }

    public function testpluralizeSingleElement()
    {
        $this->assertEquals("1 cat", $this->helper->pluralize(1, 'cat'));
    }

    public function testpluralizeMultipleElement()
    {
        $this->assertEquals("2 dogs", $this->helper->pluralize(2, 'dog'));
    }

} // HelpersTest 
