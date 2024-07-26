<?php

namespace Grid\HexGrid;

class Hex
{
    public array $coords = [
      'q' => 0,
      'r' => 0,
      's' => 0,
    ];

    public function __construct($coords)
    {
        if($coords[0] + $coords[1] + (-$coords[0] - $coords[1]) !== 0)
        {
            throw new \InvalidArgumentException('x + y + z is not 0');
        }

        $this->coords['q'] = $coords[0];
        $this->coords['r'] = $coords[1];
        $this->coords['s'] = -$coords[0] - $coords[1];
    }

}