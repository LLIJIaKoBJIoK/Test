<?php

namespace Grid\HexGrid;

class Layout
{
    protected Orientation $orientation;
    protected float $size;

    public function __construct($orientation, $size)
    {
        $this->orientation = $orientation;
        $this->size = $size;
    }

    //Кубические координаты в экранные
    public function hex_to_pixel(Hex $hex): Point
    {
        $M = $this->orientation;
        $x = ($M->f0 * $hex->coords['q'] + $M->f1 * $hex->coords['r']) * $this->size;
        $y = ($M->f2 * $hex->coords['q'] + $M->f3 * $hex->coords['r']) * $this->size;
        return new Point($x, $y);
    }

    public function pointy_hex_corner($i): Point
    {
        $M = $this->orientation;
        $size = $this->size;

        $angel = 2.0 * pi() * ($M->start_angel - $i) / 6;
        //Убрать прибавку и сделать правильную работу с отрицательными координатами
        return new Point($size * cos($angel), $size * sin($angel) + 100);
    }

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