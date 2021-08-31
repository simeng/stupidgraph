<?php

namespace Simeng\Stupidgraph;

use GdImage;
use Exception;

class Axis {
    public const DIRECTION_UP = 1;
    public const DIRECTION_RIGHT = 2;

    public function setScale($scale)
    {
        $this->scale = $scale;
    }
    public function draw(GdImage $image, int $x, int $y, int $direction, int $length, $color) {

        if ($direction === self::DIRECTION_UP) {
            $this->drawArrow($image, $x, $y - $length, $direction, $color);
            imageline($image, $x, $y - $length, $x, $y, $color);
        } elseif ($direction === self::DIRECTION_RIGHT) {
            $this->drawArrow($image, $x + $length, $y, $direction, $color);
            imageline($image, $x, $y, $x + $length, $y, $color);
        } else {
            throw new Exception("Direction not implemented");
        }

        return $image;
    }

    private function drawArrow($image, $x, $y, $direction, $color, $size = 5) 
    {
        if ($direction === self::DIRECTION_UP) {
            imagefilledpolygon($image, [
                $x-$size*.5, $y, 
                $x+$size*.5, $y, 
                $x, $y-$size
            ], 3, $color);
        } elseif ($direction === self::DIRECTION_RIGHT) {
            imagefilledpolygon($image, [
                $x, $y-$size*.5,
                $x, $y+$size*.5,
                $x+$size, $y
            ], 3, $color);
        } elseif ($direction === self::DIRECTION_DOWN) {
        } elseif ($direction === self::DIRECTION_LEFT) {
        }
    }
}


