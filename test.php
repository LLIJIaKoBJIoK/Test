<?php

$arrHexCoords = [];

//Вычисляет координаты углов Гекса
function pointy_hex_corner($centerHexCoords, $size, $i)
{
    global $arrHexCoords;
    global $centerHexCoords;

    $angel_deg = 60 * $i - 30;
    $angel_rad = pi() / 180 * $angel_deg;
    $arrHexCoords[] = $centerHexCoords['x'] + $size * cos($angel_rad) + 500;
    $arrHexCoords[] = $centerHexCoords['y'] + $size * sin($angel_rad) + 450;
}

//Рисует Гекс
function drawHex($size, $centerHexCoords)
{
    global $arrHexCoords;

    for ($i = 1; $i <=6; $i++)
    {
        pointy_hex_corner($centerHexCoords, $size, $i);
    }

    $temp =  "'" . $arrHexCoords[0] . ',' . $arrHexCoords[1] . ' ' .
      $arrHexCoords[2] . ',' . $arrHexCoords[3] . ' ' .
      $arrHexCoords[4] . ',' . $arrHexCoords[5] . ' ' .
      $arrHexCoords[6] . ',' . $arrHexCoords[7] . ' ' .
      $arrHexCoords[8] . ',' . $arrHexCoords[9] . ' ' .
      $arrHexCoords[10] . ',' . $arrHexCoords[11] . ' ' . "'";

    //echo "<polygon points=" . $temp . "fill='rgb(234,234,234)' id='N' stroke-width='1' stroke='rgb(0,0,0)'/>";

    echo json_encode($arrHexCoords);
    $arrHexCoords = [];

}

