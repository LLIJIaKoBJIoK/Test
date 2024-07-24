<?php
require_once 'template.php';

//header('Content-type: image/png');

$size = 30;
$centerHexCoords = [
  'x' => 0,
  'y' => 0,
];
$arrHexCoords = [];

$mapHex = [
  NULL, NULL, NULL, [0,-3], [1,-3], [2,-3], [3,-3],
  NULL, NULL, [-1,-2], [0,-2], [1,-2], [2,-2], [3,-2],
  NULL, [-2,-1], [-1,-1], [0,-1], [1,-1], [2,-1],[3,-1],
  [-3,0], [-2,0], [-1,0], [0,0], [1,0], [2,0], [3,0],
  [-3,1], [-2,1], [-1,1], [0,1], [1,1], [2,1], NULL,
  [-3,2], [-2,2], [-1,2], [0,2], [1,2], NULL, NULL,
  [-3,3], [-2,3], [-1,3], [0,3], NULL, NULL, NULL,
];

//Вычисляет координаты углов Гекса
function pointy_hex_corner($size, $i)
{
  global $arrHexCoords;
  global $centerHexCoords;

  $angel_deg = 60 * $i - 30;
  $angel_rad = pi() / 180 * $angel_deg;
  $arrHexCoords[] = $centerHexCoords['x'] + $size * cos($angel_rad) + 200;
  $arrHexCoords[] = $centerHexCoords['y'] + $size * sin($angel_rad) + 200;
}

//Рисует Гекс
function drawHex($image)
{
  global $size;
  global $arrHexCoords;

  for ($i = 1; $i <=6; $i++)
  {
    pointy_hex_corner($size, $i);
  }

  $temp =  "'" . $arrHexCoords[0] . ',' . $arrHexCoords[1] . ' ' .
    $arrHexCoords[2] . ',' . $arrHexCoords[3] . ' ' .
    $arrHexCoords[4] . ',' . $arrHexCoords[5] . ' ' .
    $arrHexCoords[6] . ',' . $arrHexCoords[7] . ' ' .
    $arrHexCoords[8] . ',' . $arrHexCoords[9] . ' ' .
    $arrHexCoords[10] . ',' . $arrHexCoords[11] . ' ' . "'";

  echo "<polygon points=" . $temp . "fill='rgb(234,234,234)' id='N' stroke-width='1' stroke='rgb(0,0,0)'/>";
  $arrHexCoords = [];
}

//Рисует карту Гексов
function drawMap($mapHex)
{
  echo "<svg width='500' height='1000'>";
  global $centerHexCoords;
  global $size;
  $image = imageCreateTrueColor(600, 600);

  foreach ($mapHex as $hex)
  {
    if ($hex == NULL) continue;

    $q = $hex[0];
    $r = $hex[1];

    $centerHexCoords['x'] = $size * sqrt(3) * ($q + $r/2);
    $centerHexCoords['y'] = $size * 3/2 * $r;
    drawHex($image);
  }
  echo "</svg>";
  //imagepng($image);
  //imagedestroy($image);
}

drawMap($mapHex);
