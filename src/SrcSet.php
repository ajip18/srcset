<?php

namespace wappr;

class SrcSet {
	public static function img($image, $width, $alt, $breakpoints)
	{
		$images = '';
		$parts = pathinfo($image);
		foreach($breakpoints as $breakpoint) {
			$images .= $parts['filename'] 
					. '--' 
					. $breakpoint 
					. '.' 
					. $parts['extension'] 
					. ' '
					. $breakpoint . 'w'
					.',';
		}
		$images = rtrim($images, ',');
		include(dirname(__FILE__) . '/img.php');
		return $img;
	}
}
