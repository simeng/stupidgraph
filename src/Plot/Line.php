<?php

namespace Simeng\Stupidgraph\Plot;

class Line {
    public function setScale($xScale, $yScale) 
    {
        $this->xScale = $xScale;
        $this->yScale = $yScale;
    }
    public function draw($image, $values, $x, $y, $width, $height, $color) {

        $points = [];
        foreach ($values as $num => $v) {
            $points[] = $x + $this->xScale->get($num);
            $points[] = $y + $height - $this->yScale->get($v);
        } 
        imageopenpolygon($image, $points, count($points)/2, $color);

        return $image;
    }
}

