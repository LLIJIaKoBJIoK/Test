<?php

require 'vendor/autoload.php';
require_once 'template.php';

use Game\Game;
use Grid\HexGrid\Orientation;

function drawTable($mapSize, $arr)
{
  echo "<table border='1' cellpadding='10'>";
  for ($i = 0; $i < $mapSize * 2 - 1; $i++)
  {
    echo "<tr>";
    for ($j = 0; $j < $mapSize * 2 - 1; $j++)
      {
        if($arr[$j][$i] == NULL)
        {
          echo "<td bgcolor='#a52a2a' width='50' height='50' align='center'>" . 'NULL' .  "</td>";
        } else {
          echo "<td width='50' height='50' align='center'>" . $arr[$j][$i][0] . ',' . $arr[$j][$i][1] .  "</td>";
        }
      }
    echo "</tr>";
  }
  echo "</table>";
}

$pointy = new Orientation(sqrt(3.0), sqrt(3.0) / 2.0, 0.0, 3.0 / 2.0, sqrt(3.0) / 3.0, -1.0 / 3.0, 0.0, 2.0 / 3.0, 0.5);
$flat = new Orientation(3.0 / 2.0, 0.0, sqrt(3.0) / 2.0, sqrt(3.0), 2.0 / 3.0, 0.0, -1.0 / 3.0, sqrt(3.0) / 3.0, 0.0);

$game = new Game(2, 20);
$game->setMapHexSize(2)
  ->setHexSize(100)
  ->setHexOrientation($pointy);

$game->run();