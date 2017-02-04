<?php

namespace wappr;

class SrcSet
{
    public static function img($image, $width, $alt, $breakpoints)
    {
        $html = '';
        $images = '';
        $parts = pathinfo($image);
        foreach ($breakpoints as $breakpoint) {
            $images .= $parts['dirname'] .'/' .$parts['filename']
                    .'--'
                    .$breakpoint
                    .'w.'
                    .$parts['extension']
                    .' '
                    .$breakpoint.'w'
                    .',';
        }
        $images = rtrim($images, ',');
        include dirname(__FILE__).'/img.php';

        return $html;
    }
}
