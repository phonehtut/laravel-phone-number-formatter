<?php
namespace NewwayMyanmar\PhoneNumberFormatter\Facades;

use Illuminate\Support\Facades\Facade;

class PhoneNumberFormatter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'phoneformatter';
    }
}
