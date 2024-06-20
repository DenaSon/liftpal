<?php
/*
|--------------------------------------------------------------------------
| Optimize Functions
|--------------------------------------------------------------------------
|| Here is for common website functions as optimization helper . These
| functions are loaded by the laravel in everywhere  and all of them will
| be assigned to the "optimization" model . for SEO options and ....
|*/

use App\Models\Optimization;
/**
 * Get Setting Value Based On Setting Key
 *
 * @param string|null $key
 * @return mixed
 */
function getSeoSetting(string $key = null) : mixed
{
    try {

        $setting = Optimization::where('key', $key)->value('value');
        return $setting ?? null;

    }
    catch (Throwable $e)
    {
        setLog('Get-SeoSettingHelper',$e->getMessage() . ' File : '. $e->getFile(),'danger');

    }
   return false;

}




