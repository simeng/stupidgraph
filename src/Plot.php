<?php

namespace Simeng\Stupidgraph;

class Plot {
    public function setScale($xScale, $yScale) 
    {
        $this->xScale = $xScale;
        $this->yScale = $yScale;
    }
    public function draw($image, $values, $x, $y, $width, $height, $color) {

        $points = [];
        foreach ($values as $num => $v) {
            $points[] = $this->xScale->get($num);
            $points[] = $height - $this->yScale->get($v);
        }
        imageopenpolygon($image, $points, count($points)/2, $color);

        return $image;
    }
}

