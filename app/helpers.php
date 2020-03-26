<?php

if (! function_exists('price_with_currency'))
{
    function price_with_currency($key)
    {
        $locale = App::getLocale();
        if($locale == 'ro') {
            echo $key . ' lei';
        } else {
            echo '$ ' . $key ;
        }
    }
}

/**
* Retrieve cart from session as array
*/
if (! function_exists('cartItems'))
{
    function cartItems()
    {
        return (!empty(session()->get('cart'))) ? session()->get('cart') : array();
    }
}
