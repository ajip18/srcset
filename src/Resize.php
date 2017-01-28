<?php

namespace wappr;

class Resize
{
    public $filename;

    public $width;
    public $height;
    public $type;
    public $arr;

    public $breakpoints = [320, 768, 1224, 1824];

    public function __construct($filename)
    {
        $this->filename = $filename;
        list(
            $this->width,
            $this->height,
            $this->type,
            $this->attr
        ) = getimagesize($this->filename);
    }

    public function run() {
    	foreach($this->breakpoints as $breakpoint) {
    		echo $breakpoint . ' / ' . $this->width . "\n";
    		$ratio =  $breakpoint / $this->width . "\n";
    		echo "New height: " . $ratio * $this->height . "\n";
    		if($ratio > 1) {
    			echo 'Do not stretch image?' . "\n";
    		}
    		echo "\n";
    	}
    }
}
