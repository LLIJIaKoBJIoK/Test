<?php

namespace Grid\HexGrid;

class Layout
{
    protected Orientation $orientation;
    protected float $hexSize;

    public function __construct($orientation, $hexSize)
    {
        $this->orientation = $orientation;
        $this->hexSize = $hexSize;
    }

    //Кубические координаты в экранные
    public function hex_to_pixel(Hex $hex): Point
    {
        $M = $this->orientation;
        $x = ($M->f0 * $hex->coords['q'] + $M->f1 * $hex->coords['r']) * $this->hexSize;
        $y = ($M->f2 * $hex->coords['q'] + $M->f3 * $hex->coords['r']) * $this->hexSize;
        return new Point($x, $y);
    }

    private function pointy_hex_corner($i): Point
    {
        $M = $this->orientation;
        $hexSize = $this->hexSize;

        $angel = 2.0 * pi() * ($M->start_angel - $i) / 6;

        return new Point($hexSize * cos($angel), $hexSize * sin($angel));
    }

  //Углы шетиугольника
    public function HexCorners(Hex $hex): array
    {
        $corners = [];
        $center = $this->hex_to_pixel($hex);
        for ($i = 0; $i < 6; $i ++)
        {
          $offset = $this->pointy_hex_corner($i);
          $corners[] = new Point($center->x + $offset->x, $center->y + $offset->y);
        }
        return $corners;
    }
}