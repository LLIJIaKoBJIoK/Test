<?php
require_once 'template.php';
require_once 'test.php';

require 'vendor/autoload.php';

use Grid\HexGrid\Layout;

//header('Content-type: image/png');

$size = 75;
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
  echo "<svg width='1000' height='900'>";
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
    drawHex($size, $centerHexCoords);
  }
  echo "</svg>";
  //imagepng($image);
  //imagedestroy($image);
}

drawMap($mapHex);

$pointy = new \Grid\HexGrid\Orientation(sqrt(3.0), sqrt(3.0) / 2.0, 0.0, 3.0 / 2.0, sqrt(3.0) / 3.0, -1.0 / 3.0, 0.0, 2.0 / 3.0, 0.5);
$flat = new \Grid\HexGrid\Orientation(3.0 / 2.0, 0.0, sqrt(3.0) / 2.0, sqrt(3.0), 2.0 / 3.0, 0.0, -1.0 / 3.0, sqrt(3.0) / 3.0, 0.0);

$layout = new Layout($pointy, 75, [0,0]);
$e = $layout->hex_to_pixel(new \Grid\HexGrid\Hex([0, -3]));
var_dump($e);
