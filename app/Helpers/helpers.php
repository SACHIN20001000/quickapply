<?php

use App\Models\GlobalSetting;


if (!function_exists('globalSetting')) {
    function globalSetting()
    {
      return GlobalSetting::orderBy('id', 'desc')->first();
    }
}
