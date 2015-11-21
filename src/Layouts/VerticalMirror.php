<?php
// VerticalMirror.php
namespace Hedronium\Avity\Layouts;

use Hedronium\Avity\Layout;
use Hedronium\Avity\Generator;

class VerticalMirror extends Layout
{
  	public $rows = 5;
  	public $columns = 5;


    public function drawGrid()
    {
        // This object was injected into contructer
      	// Ex: Passed in as parameter from avity main object
        $gen = $this->generator;

      	// Stores the whole grid as an array
        $grid = [];

      	// The Maximum number of column that need to be generated by generator
      	// Not All column need to be filled because of mirroring
        $max_columns = $this->columns/2;

      	// Subtract `1` from max columns if the number of columns is even (as array indexes start from `0`)
        if ($this->columns&1 === 0) {
              $max_columns -= 1;
        }

      	$max_columns = ceil($max_columns);

        // This is the loop for rows
        for ($y = 0; $y < $this->rows; $y++) {

            // This will store the column value of the row
            $grid[$y] = [];

          	// Initializes the grid value with false
          	// Ex: Amra first e Shob false kore rakhlam , mane tottaly shada ekta canvas nibo then er upor ja akakai or square aka sheta pore
          	for ($x = 0; $x < $this->columns; $x++) {
                $grid[$y][$x] = false;
            }

			// Loads Column values with generator values
          	// Ex: ei loop ta column er vitor kon kon ghorer vitor aka hobe sheta nirnoy kore dey using boolean value
          	// Eta ekta column value theke mirror column value dictate kore  dey

            for ($x = 0; $x < $max_columns; $x++) {
                // Loads boolean value from generator object
                $value = $gen->shouldDraw($x, $y);
                // Sets value into the current column
                $grid[$y][$x] = $value;
                // Sets same value into the oposite mirror column
                $grid[$y][($this->columns-1)-$x] = $value;
            }

        }

        return $grid;
    }
}
