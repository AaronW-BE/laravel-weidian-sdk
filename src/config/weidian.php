<?php
if (!defined("WD_API_HOST")) {
    define("WD_API_HOST", "https://api.vdian.com/");
}
return [
    "appkey" => env('WEIDIAN_APP_KEY', ""),
    "secret" => env('WEIDIAN_APP_SECRET', ""),

    "oneself_appkey" => env("WEIDIAN_SELF_APPKEY", ""),
    "oneself_secret" => env("WEIDIAN_SELF_SECRET", ""),

    "wd_api" => WD_API_HOST . "api",

    "debug" => true,
    "online" => false

];