<?php

namespace MacsiDigital\Skeleton\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MacsiDigital\Skeleton\Skeleton
 */
class Package extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'skeleton.package';
    }
}
