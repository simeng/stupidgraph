<?php

namespace Simeng\Stupidgraph\Scale;

class Linear {
    public function setDomain($min, $max) 
    {
        $this->domainMin = $min;
        $this->domainMax = $max;
        $this->domainHeight = $max - $min;
        return $this;
    }
    public function setRange($min, $max)
    {
        $this->rangeMin = $min;
        $this->rangeMax = $max;
        $this->rangeHeight = $max - $min;
        return $this;
    }
    public function get($value) 
    {
        return $this->rangeMin + (
            $this->rangeHeight * 
            (($value - $this->domainMin) / $this->domainHeight)
        );
    }
    public function __toString() 
    {
        $string = "domain [{$this->domainMin}, {$this->domainMax}]";
        $string .= " range [{$this->rangeMin}, {$this->rangeMax}]";
        return $string;
    }
}


