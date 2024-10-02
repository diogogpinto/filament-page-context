<?php

namespace DiogoGPinto\FilamentPageContext\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DiogoGPinto\FilamentPageContext\FilamentPageContext
 */
class FilamentPageContext extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \DiogoGPinto\FilamentPageContext\FilamentPageContext::class;
    }
}
