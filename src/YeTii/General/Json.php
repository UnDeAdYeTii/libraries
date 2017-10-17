<?php

namespace YeTii\General;

/**
 * Class Json
 */
class Json
{
    /**
     * @param      $json
     * @param bool $die
     */
    public static function output($json, $die = false)
    {
        Debug::json($json, $die);
    }

    /**
     * @param $json
     * @return mixed
     */
    public static function toString($json)
    {
        return json_decode($json);
    }
}
