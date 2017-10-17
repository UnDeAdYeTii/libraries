<?php

namespace YeTii\General;

class Json
{
    public static function output($json, $die = false)
    {
        Debug::json($json, $die);
    }

    public static function toString($json)
    {
        return json_decode($json);
    }
}
