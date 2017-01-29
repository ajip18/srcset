<?php

namespace wappr;

class Resize
{
    public $hash;
    public $filename;

    public $image;

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

        if ($this->type == 'image/jpeg') {
            $this->image = imagecreatefromjpeg($this->filename);
        } elseif ($this->type == 3) {
            $this->image = imagecreatefrompng($this->filename);
        } elseif ($this->type == 'image/gif') {
            $this->image = imagecreatefromgif($this->filename);
        }
        $this->hash();
        if (!file_exists(getcwd().'/'.$this->hash)) {
            mkdir(getcwd().'/'.$this->hash, 0777, true);
        }
    }

    public function run()
    {
        foreach ($this->breakpoints as $breakpoint) {
            echo $breakpoint.' / '.$this->width."\n";
            $ratio = $breakpoint / $this->width."\n";
            echo 'New height: '.$ratio * $this->height."\n";
            echo 'New width: '.$ratio * $this->width."\n";
            if ($ratio > 1) {
                echo 'Do not stretch image?'."\n";
            }
            echo "\n";
            $newImage = imagecreatetruecolor($this->width, $this->height);
            imagecopyresized($newImage,
                $this->image,
                0, 0, 0, 0,
                $ratio * $this->width,
                $ratio * $this->height,
                $this->width,
                $this->height
            );
            imagepng($newImage, getcwd().'/'.$this->hash.'/test.png');
            imagedestroy($newImage);
        }
    }

    protected function hash()
    {
        // get the first five characters of the sum of the
        // sha1sum of the file
        $this->hash = substr(sha1_file($this->filename), 0, 5);
    }
}
