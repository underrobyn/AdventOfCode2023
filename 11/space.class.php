<?php

const DEBUG = false;
const SPACE = ".";
const GALAXY = "#";

class Space {

	private array $internalMatrix;
	private array $galaxies;
	private int $spaceRows;
	private int $spaceCols;

	public function __construct($matrix) {
		$this->internalMatrix = $matrix;
		$this->galaxies = array();

		$this->spaceRows = count($this->internalMatrix);
		$this->spaceCols = count($this->internalMatrix[0]);

		return $this;
	}

	public function galaxyString(): string {
		return implode('', array_map('implode', $this->internalMatrix));
	}

	public function get($x, $y) {
		if (!isset($this->internalMatrix[$x][$y])) {
			echo "Internal matrix error - can't get ($x,$y)";
			print_r($this->internalMatrix);
			die();
		}
		return $this->internalMatrix[$x][$y];
	}

	public function show(): void {
		$show = "Space has {$this->spaceRows} rows, {$this->spaceCols} columns.\n";
		foreach ($this->internalMatrix as $row){
			$show .= implode("", $row) . "\n";
		}
		echo "$show\n";
	}

	public function showSelection($x, $y): void {
		$show = "\tSpace has {$this->spaceRows} rows, {$this->spaceCols} columns.\n";
		$show .= "\t\tShowing: $x, $y: '" . $this->get($x, $y) . "'\n\t";
		for ($i = 0; $i < $this->spaceCols; $i++) {
			$show .= ($i === $x) ? "v\t" : "$i\t";
		}
		$show .= "\n";

		$rowId = 0;
		foreach ($this->internalMatrix as $row) {
			$show .= (($rowId === $y) ? ">\t" : "$rowId\t") . implode("\t", $row) . "\n";
			$rowId++;
		}
		echo "$show\n";
	}

	public function expandSpace(): void {
		$this->expandSpaceRows()->expandSpaceCols();
	}

	private function expandSpaceRows(): Space {
		for ($i = 0; $i < $this->spaceRows; $i++) {
			$expandRow = true;
			if (DEBUG) print("> searching row {$i}\n");

			for ($j = 0; $j < $this->spaceCols; $j++) {
				if ($this->get($i, $j) === GALAXY) {
					if (DEBUG) print("\n>> found galaxy on row $i\n\n");
					$expandRow = false;
					break;
				}
			}

			// We didn't encounter any galaxies, so expand the row!
			if (!$expandRow) continue;

			if (DEBUG) print("\n>>> Expanding space from row $i\n");

			array_splice( $this->internalMatrix, $i, 0, array( $this->internalMatrix[$i] ));
			$this->spaceRows++;
			$i += 1;

			if (DEBUG) print(">>> Space is now {$this->spaceRows} rows incremented counter to: {$i}\n");
		}

		return $this;
	}

	private function expandSpaceCols(): Space {
		for ($i = 0; $i < $this->spaceCols; $i++) {
			$expandCol = true;
			if (DEBUG) print("> searching col {$i}\n");

			for ($j = 0; $j < $this->spaceRows; $j++) {
				if ($this->get($j, $i) === GALAXY) {
					//if (DEBUG) print("\n>> found galaxy in col $i\n\n");
					$expandCol = false;
					break;
				}
			}

			// We didn't encounter any galaxies, so expand the row!
			if (!$expandCol) continue;

			if (DEBUG) print("\n>>> Expanding space from col $i\n");

			for ($j = 0; $j < $this->spaceRows; $j++) {
				array_splice( $this->internalMatrix[$j], $i, 0, SPACE);
			}

			$this->spaceCols++;
			$i += 1;

			if (DEBUG) print(">>> Space is now {$this->spaceCols} cols incremented counter to: {$i}\n");
		}

		return $this;
	}

	public function findGalaxies(): void {
		$galaxy_count = count_chars($this->galaxyString())[ord('#')];

		if (DEBUG) print("There are $galaxy_count galaxies in space.\n");

		$galaxyNumber = 1;
		for ($i = 0; $i < $this->spaceRows; $i++) {
			for ($j = 0; $j < $this->spaceCols; $j++) {
				if ($this->get($i, $j) === GALAXY) {
					$this->galaxies[$galaxyNumber] = [$i, $j];
					$galaxyNumber++;
				}
			}
		}
	}

	public function getGalaxyList(): array {
		return $this->galaxies;
	}

	public function findDistance($a, $b): int {
		$posA = $this->galaxies[$a];
		$posB = $this->galaxies[$b];

		$diffX = abs($posA[0] - $posB[0]);
		$diffY = abs($posA[1] - $posB[1]);
		$distance = $diffX + $diffY;

		print("Distance between $a and $b is ($diffX, $diffY): $distance\n");

		return $distance;
	}

}