<?php

namespace ToxyTech\Api\Facades;

use ToxyTech\Api\Supports\ApiHelper as ApiHelperSupport;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string modelName()
 * @method static \ToxyTech\Api\Supports\ApiHelper setModelName(string $modelName)
 * @method static string|null guard()
 * @method static string|null passwordBroker()
 * @method static string|null getConfig(string $key, $default = null)
 * @method static mixed setConfig(array $config)
 * @method static \Illuminate\Database\Eloquent\Model|null newModel()
 * @method static string getTable()
 * @method static bool enabled()
 *
 * @see \ToxyTech\Api\Supports\ApiHelper
 */
class ApiHelper extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ApiHelperSupport::class;
    }
}
