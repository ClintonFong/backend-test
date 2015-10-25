<?php

namespace Finder;

if(!defined('ROUND_UP'))    { define('ROUND_UP', 1); }
if(!defined('ROUND_DOWN'))  { define('ROUND_DOWN', -1); }

class Helpers
{
    public $money_rounding = ROUND_UP;

    //-------------------------------------------------
    public function months($period)
    {
        if(!is_numeric($period)) {
            return '';
        }
        return ($period == 1) ? "1 month" : "$period months";

    } // months

    //-------------------------------------------------
    public function yesNo($value)
    {
        if ( ( is_numeric($value) && $value == 0 ) || strtolower($value) == 'no') {
            return 'No';
        }
        else if ( ( is_numeric($value) && $value != 0 ) || strtolower($value) == 'yes') {
            return 'Yes';
        }
        return '';

    } // yesNo

    //-------------------------------------------------
    public function money($value, $decimals = 2)
    {
        if (!is_numeric($value) || !is_numeric($decimals)) {
            return $value;
        }

        $dollarValue    = floor( $value );
        $centValue      = ( $this->money_rounding == ROUND_UP )? $value - $dollarValue 
                                                               : $this->roundDownDecimals( $value - $dollarValue, $decimals ); 
        $value          = $dollarValue + $centValue;
        $decimals       = ( $centValue > 0.0)? $decimals : 0;

        return sprintf('$%s', number_format($value, $decimals));

    } // money

    //-------------------------------------------------
    public function date( $data, 
                          $format = 'Y-m-d h:i:s',
                          $outputTimezone = '' )
    {
        try {
            $time = new \DateTime($data);
        }
        catch(Exception $e) {
            return $data;
        }

        if( $outputTimezone != '' ) { $time->setTimezone( new \DateTimeZone( $outputTimezone )); }
        return $time->format($format);

    } // date

    //-------------------------------------------------
    public function currency( $value,
                              $currency = 'USD' )
    {
        // use of NumberFormatter from extension package intl
        //
        $formatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($value, $currency);

    } // currency

    //-------------------------------------------------
    public function listSentence( array $list )
    {
        $sRetList   = "";
        $nItems     = count( $list );

        for( $i = 0; $i < $nItems; $i++ )
        {
            if( $i > 0 ) 
            {
                $sRetList .= ( $i < $nItems-1 )? ", " : " and ";
            }
            $sRetList .= $list[$i];
        }
        return $sRetList;

    } // listSentence

    //-------------------------------------------------
    public function pluralize($data, $unit)
    {
        if (!is_numeric($data)) {
            return $data;
        }
        if ($data == 1) {
            return sprintf('%s %s', $data, $unit);
        } else {
            return sprintf('%s %ss', $data, $unit);
        }

    } // pluralize

    //-------------------------------------------------
    // protected functions
    //-------------------------------------------------
    protected function roundDownDecimals( $decimalValue, $decimals = 2)
    {
        $pow = pow( 10, $decimals );
        return floor( $decimalValue * $pow) / $pow;

    } // roundDownDecimals


} // Helpers
