<?php

namespace Grid\HexGrid;

class Point
{
    public float $x;
    public float $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

}