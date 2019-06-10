<?php


namespace Heymom\Weidian\Facades;


use Heymom\Weidian\Client;
use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed getSelfToken()
 * @method static setParams(array $array)
 * @method static Weidian request(string $VDIAN_ORDER_GET, array $array, string $string)
 * @method send()
 */
class Weidian extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "weidian";
    }

}