<?php

namespace wappr;

class Resize
{
	public $filename;
    public $imagesize;

    public function __construct($filename) {
    	$this->filename = $filename;
    }
}
