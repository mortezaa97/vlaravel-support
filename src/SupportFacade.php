<?php

namespace Mortezaa97\Support;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mortezaa97\Support\Skeleton\SkeletonClass
 */
class SupportFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'support';
    }
}
