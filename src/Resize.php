<?php

namespace wappr;

class Resize
{
    public $hash;
    public $filename;
    public $pathInfo;

    public $image;

    public $width;
    public $height;
    public $type;
    public $arr;

    public $breakpoints = [320, 360, 380, 410, 760];

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->pathInfo = pathinfo($this->filename);
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
            mkdir(getcwd().'/images/'.$this->hash, 0777, true);
        }
        copy($this->filename, getcwd().'/images/'.$this->hash.'/'.$this->pathInfo['filename'] . '.'.$this->pathInfo['extension']);
    }

    public function run()
    {
        $copyImage = imagecreatetruecolor($this->width, $this->height);
        imagecopyresized($copyImage,
                $this->image,
                0, 0, 0, 0,
                $this->width,
                $this->height,
                $this->width,
                $this->height
            );
        imagejpeg(
            $copyImage, 
            getcwd().'/images/'.$this->hash.'/'.$this->pathInfo['filename'] . '.jpg', 
                80);
        foreach ($this->breakpoints as $breakpoint) {
            echo $breakpoint.' / '.$this->width."\n";
            $ratio = $breakpoint / $this->width."\n";
            echo 'New height: '.$ratio * $this->height."\n";
            echo 'New width: '.$ratio * $this->width."\n";
            if ($ratio > 1) {
                echo 'Do not stretch image?'."\n";
            }
            echo "\n";
            if(($ratio * $this->height) > 200) {
                $height = 200;
            } else {
                $height = round($ratio * $this->height);
            }
            $newImage = imagecreatetruecolor($ratio * $this->width, $height);
            imagecopyresized($newImage,
                $this->image,
                0, 0, 0, 0,
                round($ratio * $this->width),
                $height,
                $this->width,
                $this->height
            );
            imagepng($newImage, getcwd().'/images/'.$this->hash.'/'.$this->getFilename($ratio), 9, PNG_NO_FILTER);
            imagejpeg(
                $newImage, 
                getcwd().'/images/'.$this->hash.'/'.$this->getFilename($ratio, true), 
                80);
            imagedestroy($newImage);
        }
    }

    protected function getFilename($ratio, $jpg = false)
    {
        $filename = $this->pathInfo['filename'].'--'.round($this->width * $ratio).'w.';
        
        if($jpg) {
            return $filename . 'jpg';
        }

        return $filename.$this->pathInfo['extension'];
    }

    protected function hash()
    {
        // get the first five characters of the sum of the
        // sha1sum of the file
        $this->hash = substr(sha1_file($this->filename), 0, 5);
    }
}
