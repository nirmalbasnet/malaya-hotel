<?php
/**
 * Created by PhpStorm.
 * User: hp pav 14
 * Date: 20-Dec-18
 * Time: 9:56 PM
 */

namespace App\Helpers;


use App\BackendModel\Destination;

class SlugMaker
{
    public static $count = 0;
    public  static function slugMaker($string)
    {
        $string = str_replace(' ', '-', $string);
        $string = str_replace('/', '-', $string);
        $string = str_replace('\\', '-', $string);
        $string = str_replace(',', '-', $string);
        $string = str_replace(';', '-', $string);
        $string = str_replace('?', '-', $string);
        $string = str_replace(':', '-', $string);
        $string = str_replace("'", '', $string);
        $string = str_replace('"', '', $string);
        $string = str_replace('!', '', $string);
        $string = str_replace('’', '', $string);
        $string = strtolower($string);
        $string = preg_replace('/-+/', '-', $string);
        if(substr($string, -1) == '-')
        {
            $string = rtrim($string, '-');
        }
        $string = self::checkSlug($string);
        return $string;
    }

    public static function checkSlug($string)
    {
        if (Destination::where('slug', $string)->count() > 0) {
            self::$count += 1;
            $string = $string.'-'.self::$count;
            self::checkSlug($string);
        }
        return $string;
    }
}