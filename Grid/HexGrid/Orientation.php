<?php

namespace Grid\HexGrid;

class Orientation
{
    protected $f0;
    protected $f1;
    protected $f2;
    protected $f3;

    protected $b0;
    protected $b1;
    protected $b2;
    protected $b3;

    protected $start_angel;

    public function __construct($f0, $f1, $f2, $f3, $b0, $b1, $b2, $b3, $start_angle)
    {
        $this->f0 = $f0;
        $this->f1 = $f1;
        $this->f2 = $f2;
        $this->f3 = $f3;
        $this->b0 = $b0;
        $this->b1 = $b1;
        $this->b2 = $b2;
        $this->b3 = $b3;
        $this->start_angel = $start_angle;
    }
}