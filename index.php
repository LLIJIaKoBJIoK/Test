<?php

require 'vendor/autoload.php';
require_once 'template.php';

use Grid\HexGrid\Layout;
use Grid\HexGrid\Hex;
use Grid\HexGrid\Orientation;

$mapHex1 = [
  [3,0], [4,0], [5,0], [6,0],
  [2,1], [3,1], [4,1], [5,1], [6,1],
  [1,2], [2,2], [3,2], [4,2], [5,2],[6,2],
  [0,3], [1,3], [2,3], [3,3], [4,3], [5,3], [6,3],
  [0,4], [1,4], [2,4], [3,4], [4,4], [5,4],
  [0,5], [1,5], [2,5], [3,5], [4,5],
  [0,6], [1,6], [2,6], [3,6],
];

$mapHex = [];

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
function generateMap($mapSize): array
{
  $mapHex = [];
  $arrSize = $mapSize * 2 - 1;
  $f = $mapSize - 1; //1
  $s = $arrSize - 1; //2


  for($r = 0; $r < $arrSize; $r++)
  {
    for($q = 0; $q < $arrSize; $q++)
    {
      //Первое смещение до центра шестиугольника
      if($q < $f)
      {
        $mapHex[$q][$r] = NULL;
        continue;
      }
      //Второе смещение от центра шестиугольника
      if($r >= $mapSize and $q >= $s)
      {
        $mapHex[$q][$r] = NULL;
        continue;
      }

      $mapHex[$q][$r] = [$q, $r];
    }

    $f -= 1;
    if($r >= $mapSize)
    {
      $s -= 1;
    }
  }

  /*
  foreach ($mapHex as $hex)
  {
    if($hex == 'NULL') continue;
    $t[] = $hex;
  } */
  return $mapHex;
}
function draw($corners)
{
  $temp =  "'" . $corners[0]->x . ',' . $corners[0]->y . ' ' .
    $corners[1]->x . ',' . $corners[1]->y . ' ' .
    $corners[2]->x . ',' . $corners[2]->y . ' ' .
    $corners[3]->x . ',' . $corners[3]->y . ' ' .
    $corners[4]->x . ',' . $corners[4]->y . ' ' .
    $corners[5]->x . ',' . $corners[5]->y . ' ' . "'";

  echo "<polygon points=" . $temp . "fill='rgb(234,234,234)' id='N' stroke-width='1' stroke='rgb(0,0,0)'/>";
}
function drawLine($corners)
{
  $temp = "x1=" . "'" . $corners[0]->x . "'" . " " .
    "y1=" . "'" . $corners[0]->y . "'" . " " .
    "x2=" . "'" . $corners[1]->x . "'" . " " .
    "y2=" . "'" . $corners[1]->y . "'" . " ";
  echo "<line " . $temp . "stroke-width='8' stroke='rgb(0,200,200)'/>";

  $temp = "x1=" . "'" . $corners[1]->x . "'" . " " .
    "y1=" . "'" . $corners[1]->y . "'" . " " .
    "x2=" . "'" . $corners[2]->x . "'" . " " .
    "y2=" . "'" . $corners[2]->y . "'" . " ";
  echo "<line " . $temp . "stroke-width='8' stroke='rgb(0,200,200)'/>";

  $temp = "x1=" . "'" . $corners[2]->x . "'" . " " .
    "y1=" . "'" . $corners[2]->y . "'" . " " .
    "x2=" . "'" . $corners[3]->x . "'" . " " .
    "y2=" . "'" . $corners[3]->y . "'" . " ";
  echo "<line " . $temp . "stroke-width='8' stroke='rgb(0,200,200)'/>";

  $temp = "x1=" . "'" . $corners[3]->x . "'" . " " .
    "y1=" . "'" . $corners[3]->y . "'" . " " .
    "x2=" . "'" . $corners[4]->x . "'" . " " .
    "y2=" . "'" . $corners[4]->y . "'" . " ";
  echo "<line " . $temp . "stroke-width='8' stroke='rgb(0,200,200)'/>";

  $temp = "x1=" . "'" . $corners[4]->x . "'" . " " .
    "y1=" . "'" . $corners[4]->y . "'" . " " .
    "x2=" . "'" . $corners[5]->x . "'" . " " .
    "y2=" . "'" . $corners[5]->y . "'" . " ";
  echo "<line " . $temp . "stroke-width='8' stroke='rgb(0,200,200)'/>";

  $temp = "x1=" . "'" . $corners[5]->x . "'" . " " .
    "y1=" . "'" . $corners[5]->y . "'" . " " .
    "x2=" . "'" . $corners[0]->x . "'" . " " .
    "y2=" . "'" . $corners[0]->y . "'" . " ";
  echo "<line " . $temp . "stroke-width='8' stroke='rgb(0,200,200)'/>";
}

//Генерация КАРТЫ
$pointy = new Orientation(sqrt(3.0), sqrt(3.0) / 2.0, 0.0, 3.0 / 2.0, sqrt(3.0) / 3.0, -1.0 / 3.0, 0.0, 2.0 / 3.0, 0.5);
$flat = new Orientation(3.0 / 2.0, 0.0, sqrt(3.0) / 2.0, sqrt(3.0), 2.0 / 3.0, 0.0, -1.0 / 3.0, sqrt(3.0) / 3.0, 0.0);
$size = 20;
$layout = new Layout($pointy, $size);

$mapHex = generateMap(4);
drawTable(4, $mapHex);

echo "<svg width='800' height='800'>";

foreach ($mapHex as $hexRow)
{
  foreach ($hexRow as $hex)
  {
    if ($hex == NULL) continue;
    $a = $layout->HexCorners(new Hex([$hex[0], $hex[1]]));
    draw($a);
  }
}
/*foreach ($mapHex as $hex)
{
  if ($hex == NULL) continue;
  $a = $layout->HexCorners(new Hex([$hex[0], $hex[1]]));
  drawLine($a);
} */

echo "</svg>";
