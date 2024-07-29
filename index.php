<?php
require_once 'template.php';
require_once 'test.php';

require 'vendor/autoload.php';

use Grid\HexGrid\Layout;
use Grid\HexGrid\Hex;
use Grid\HexGrid\Orientation;

//header('Content-type: image/png');

//$size = 75;
$centerHexCoords = [
  'x' => 0,
  'y' => 0,
];
//$arrHexCoords = [];

$mapHex = [
  NULL, NULL, NULL, [0,-3], [1,-3], [2,-3], [3,-3],
  NULL, NULL, [-1,-2], [0,-2], [1,-2], [2,-2], [3,-2],
  NULL, [-2,-1], [-1,-1], [0,-1], [1,-1], [2,-1],[3,-1],
  [-3,0], [-2,0], [-1,0], [0,0], [1,0], [2,0], [3,0],
  [-3,1], [-2,1], [-1,1], [0,1], [1,1], [2,1], NULL,
  [-3,2], [-2,2], [-1,2], [0,2], [1,2], NULL, NULL,
  [-3,3], [-2,3], [-1,3], [0,3], NULL, NULL, NULL,
];



//Рисует карту Гексов
function drawMap($mapHex)
{
  //echo "<svg width='1000' height='900'>";
  global $centerHexCoords;
  global $size;

  foreach ($mapHex as $hex)
  {
    if ($hex == NULL) continue;

    $q = $hex[0];
    $r = $hex[1];
    //$centerHexCoords['x'] = $size * sqrt(3) * ($q + $r/2);
    $centerHexCoords['x'] = (sqrt(3) * $q + sqrt(3) / 2 * $r) * $size;
    $centerHexCoords['y'] = $size * 3/2 * $r;
    print_r($centerHexCoords);
    drawHex($size, $centerHexCoords);
  }
  //echo "</svg>";
  //imagepng($image);
  //imagedestroy($image);
}

//drawMap($mapHex);

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


$pointy = new Orientation(sqrt(3.0), sqrt(3.0) / 2.0, 0.0, 3.0 / 2.0, sqrt(3.0) / 3.0, -1.0 / 3.0, 0.0, 2.0 / 3.0, 0.5);
$flat = new Orientation(3.0 / 2.0, 0.0, sqrt(3.0) / 2.0, sqrt(3.0), 2.0 / 3.0, 0.0, -1.0 / 3.0, sqrt(3.0) / 3.0, 0.0);
$size = 50;

$layout = new Layout($pointy, $size);

echo "<svg width='800' height='800'>";
foreach ($mapHex as $hex)
{
  if ($hex == NULL) continue;
  $a = $layout->HexCorners(new Hex([$hex[0], $hex[1]]));
  draw($a);
}

foreach ($mapHex as $hex)
{
  if ($hex == NULL) continue;
  $a = $layout->HexCorners(new Hex([$hex[0], $hex[1]]));
  drawLine($a);
}
echo "</svg>";
