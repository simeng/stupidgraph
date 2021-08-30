<?php

namespace Simeng\Stupidgraph;

class Graph {
    private $x = 0;
    private $y = 0;
    private $width = null;
    private $height = null;
    private $backgroundColor = null;

    public function __construct($width, $height) 
    {
        $this->width = $width;
        $this->height = $height;
        $this->image = imagecreatetruecolor($width, $height);
    }
    public function setBackgroundColor($color)
    {
        $this->backgroundColor = $color;
    }

    public function drawBackground()
    {
        imagefilledrectangle($this->image, $this->x, $this->y, $this->width-1, $this->height-1, $this->backgroundColor);
    }

    public function draw()
    {
        $this->drawBackground($this->x, $this->y, $this->width, $this->height);
        return $this->image;
    }

}
