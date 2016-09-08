<?php

namespace Acacha\Profile\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Profile.
 */
class Profile extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Profile';
    }
}
