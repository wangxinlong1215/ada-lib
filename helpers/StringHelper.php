<?php

namespace ada\helpers;
class StringHelper
{
    /**
     * 返回字节长度。
     * 8bit不是字符集，是php独有解析，只有php引擎可以解析，一个字节==8个位，1byte=8bit。
     * strlen('新龙');//6
     * mb_strlen('新龙');//2
     * mb_strlen('新龙', '8bit');//6
     * mb_strlen相对于strlen，性能更好，更准确。
     *
     * @param $string
     *
     * @return int
     * @author 王新龙
     * @date   2021-08-20 17:20
     */
    public static function byteLength($string)
    {
        return mb_strlen($string, '8bit');
    }

    /**
     * 返回字符串
     *
     * @param      $string
     * @param      $start
     * @param null $length
     *
     * @return string
     * @author 王新龙
     * @date   2021-08-20 17:28
     */
    public static function byteSubstr($string, $start, $length = NULL)
    {
        return mb_substr($string, $start, $length === NULL ? mb_strlen($string, '8bit') : $length, '8bit');
    }

    public static function basename($path, $suffix = '')
    {
        if (($len = mb_strlen($suffix)) > 0 && mb_substr($path, -$len) === $suffix) {
            $path = mb_substr($path, 0, -$len);
        }
        $path = rtrim(str_replace('\\', '/', $path), '/\\');
        if (($pos = mb_strrpos($path, '/')) !== FALSE) {
            return mb_substr($path, $pos + 1);
        }

        return $path;
    }

    public static function dirname($path)
    {
        $pos = mb_strrpos(str_replace('\\', '/', $path), '/');
        if ($pos !== FALSE) {
            return mb_substr($path, 0, $pos);
        }

        return '';
    }
}