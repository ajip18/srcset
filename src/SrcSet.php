<?php

namespace wappr;

class SrcSet
{
    public static function img($image, $width, $alt, $breakpoints)
    {
        $html = '';
        $images = '';
        $parts = pathinfo($image);
        rsort($breakpoints);
        foreach ($breakpoints as $breakpoint) {
            $images .= $parts['dirname'] .'/' .$parts['filename']
                    .'--'
                    .$breakpoint
                    .'w.'
                    .$parts['extension']
                    .' '
                    .$breakpoint.'w'
                    .','."\n";
        }
        $images = rtrim($images, ",\n");
        include dirname(__FILE__).'/img.php';

        return $html;
    }
}
