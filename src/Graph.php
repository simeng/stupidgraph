<?php

namespace Simeng\Stupidgraph;

use Exception;

class Graph {
    private $x = 0;
    private $y = 0;
    private $axisMargin = 0;
    private $width = null;
    private $height = null;
    private $backgroundColor = null;
    private $image = null;
    private $plot = null;
    private $setColors = [];
    private $sets = [];
    private $axis = [];

    public function __construct($width, $height) 
    {
        $this->width = $width;
        $this->height = $height;
        $this->image = imagecreatetruecolor($width, $height);
        $this->black = imagecolorallocate($this->image, 0x00, 0x00, 0x00);
        $this->setColors[] = imagecolorallocate($this->image, 0xFF, 0x00, 0x00);
        $this->setColors[] = imagecolorallocate($this->image, 0x00, 0xFF, 0x00);
        $this->setColors[] = imagecolorallocate($this->image, 0x00, 0x00, 0xFF);
        $this->plotX = $width * .1;
        $this->plotY = $height * .1;
        $this->plotWidth = $width * .8;
        $this->plotHeight = $height * .8;
    }

    public function setBackgroundColor($color)
    {
        $this->backgroundColor = $color;
    }

    public function addDataset($set) {
        $this->sets[] = $set;
    }

    public function addAxis($axis, $direction) {
        $this->axis[] = [
            'axis' => $axis,
            'direction' => $direction
        ];
    }

    public function setPlot($plot) 
    {
        $this->plot = $plot;
    }

    public function draw()
    {
        $this->drawBackground($this->x, $this->y, $this->width, $this->height);

        if (!$this->plot) {
            throw new Exception("No plot set");
        }
        foreach ($this->axis as $k => $axis) {
            if ($axis['direction'] === Axis::DIRECTION_UP) {
                $axis['axis']->draw($this->image, $this->plotX - $this->axisMargin, $this->plotY + $this->plotHeight, $axis['direction'], $this->plotHeight, $this->black);
            } elseif ($axis['direction'] === Axis::DIRECTION_RIGHT) {
                $axis['axis']->draw($this->image, $this->plotX, $this->plotY + $this->plotHeight + $this->axisMargin, $axis['direction'], $this->plotWidth, $this->black);
            }
        }
        foreach ($this->sets as $k => $set) {
            $this->plot->draw($this->image, $set, $this->plotX, $this->plotY, $this->plotWidth, $this->plotHeight, $this->setColors[$k]);
        }

        return $this->image;
    }

    private function drawBackground()
    {
        imagefilledrectangle($this->image, $this->x, $this->y, $this->width-1, $this->height-1, $this->backgroundColor);
    }


}
