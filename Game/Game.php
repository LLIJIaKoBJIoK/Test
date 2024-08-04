<?php

namespace Game;

use Grid\HexGrid\Hex;
use Grid\HexGrid\Layout;
use Grid\HexGrid\Orientation;

class Game
{
  private array $mapHex = [];
  private array $hexCorners = [];

  private int $mapHexSize;
  private int $hexSize;

  private Orientation $orientation;

  public function run(): void
  {
    $this->generateMap();
    $layout = new Layout($this->orientation, $this->hexSize);

    //echo "<svg width='1000' height='1000'>";

    //Отрисовка карты гексов
    foreach ($this->mapHex as $hexRow)
    {
      foreach ($hexRow as $hex)
      {
        if ($hex == NULL) continue;
        $corners = $layout->HexCorners(new Hex([$hex[0], $hex[1]]));
        $this->hexCorners[] = $corners;
        //$this->drawHexMap($corners);
      }
    }

    //Отрисовка карты дорог
    foreach ($this->mapHex as $hexRow)
    {
      foreach ($hexRow as $hex) {
        if ($hex == NULL) continue;
        $a = $layout->HexCorners(new Hex([$hex[0], $hex[1]]));
        //$this->drawRoad($a);
      }
    }

    //echo "</svg>";
  }

  private function generateMap(): void
  {
    $arrSize = $this->mapHexSize * 2 - 1;
    $f = $this->mapHexSize - 1;
    $s = $arrSize - 1;

    for($r = 0; $r < $arrSize; $r++)
    {
      for($q = 0; $q < $arrSize; $q++)
      {
        //Первое смещение до центра шестиугольника
        if($q < $f)
        {
          $this->mapHex[$q][$r] = NULL;
          continue;
        }
        //Второе смещение от центра шестиугольника
        if($r >= $this->mapHexSize and $q >= $s)
        {
          $this->mapHex[$q][$r] = NULL;
          continue;
        }

        $this->mapHex[$q][$r] = [$q, $r];
      }

      $f -= 1;
      if($r >= $this->mapHexSize)
      {
        $s -= 1;
      }
    }
  }

  private function drawHexMap($corners): void
  {
    $temp =  "'" . $corners[0]->x . ',' . $corners[0]->y . ' ' .
      $corners[1]->x . ',' . $corners[1]->y . ' ' .
      $corners[2]->x . ',' . $corners[2]->y . ' ' .
      $corners[3]->x . ',' . $corners[3]->y . ' ' .
      $corners[4]->x . ',' . $corners[4]->y . ' ' .
      $corners[5]->x . ',' . $corners[5]->y . ' ' . "'";

    echo "<polygon points=" . $temp . "fill='rgb(234,234,234)' id='N' stroke-width='1' stroke='rgb(0,0,0)'/>";
  }

  private function drawRoad($corners): void
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

  public function setMapHexSize($size)
  {
    $this->mapHexSize = $size;

    return $this;
  }

  public function setHexSize($size)
  {
    $this->hexSize = $size;

    return $this;
  }

  public function setHexOrientation($orientation)
  {
    $this->orientation = $orientation;

    return $this;
  }

  public function getCorners()
  {
    return $this->hexCorners;
  }
}