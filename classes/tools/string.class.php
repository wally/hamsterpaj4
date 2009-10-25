<?php

class String
{
    public static function plural($amount, $default, $on_one, $on_more)
    {
	if ( $amount > 1 )
	{
	    return sprintf($on_more, $amount);
	}
	elseif ( $amount == 1 )
	{
	    return $on_one;
	}
	else
	{
	    return $default;
	}
    }
    
    static function beginswith($string, $test)
    {
	return substr($string, 0, strlen($test)) === $test;
    }
    
    static function endswith($string, $test)
    {
	return substr($string, -strlen($test)) === $test;
    }
}
