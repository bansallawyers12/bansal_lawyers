<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Http\RedirectResponse make(array $attributes, \Closure $callback)
 * @method static object capture()
 */
class Payment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'payu.payment';
    }
}


