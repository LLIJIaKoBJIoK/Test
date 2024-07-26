<?php

namespace Grid\HexGrid;

class Layout
{
    protected Orientation $orientation;
    protected float $size;
    protected $origin;

    public function __construct($orientation, $size, array $origin)
    {
        $this->orientation = $orientation;
        $this->size = $size;
        $this->origin = $origin;
    }

    public function hex_to_pixel(Hex $hex): Point
    {
        $M = $this->orientation;
        $origin = $this->origin;
        $x = ($M->f0 * $hex->coords['q'] + $M->f1 * $hex->coords['r']) * $this->size;
        $y = ($M->f2 * $hex->coords['q'] + $M->f3 * $hex->coords['r']) * $this->size;
        return new Point($x, $y);
    }
}