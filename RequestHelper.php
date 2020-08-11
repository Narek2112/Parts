<?php

namespace App\Traits;

use Carbon\Carbon;

/**
 * Class RequestHelper
 * @package App\Traits
 */
trait RequestHelper
{
    private function toBoolean($val): bool
    {
        if ($val === 'off') {
            return false;
        }

        if ($val === '0') {
            return false;
        }

        return (bool)$val;
    }

    private function timeToDatetime($time)
    {
        if(!$time) {
            return null;
        }

        return Carbon::createFromFormat('H:i', $time)->toDateTimeString();
    }
}


