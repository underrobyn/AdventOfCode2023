<?php

$fc = file_get_contents('input.txt');

$lines = explode("\n", $fc);

// Split at space and remove empty values
$times_unfiltered = array_filter(explode(" ", $lines[0]));
$distances_unfiltered = array_filter(explode(" ", $lines[1]));

// Remove line label
unset($times_unfiltered[0]);
unset($distances_unfiltered[0]);

//print_r($times_unfiltered);
//print_r($distances_unfiltered);
$times = array_values($times_unfiltered);
$distances = array_values($distances_unfiltered);

$totalsPossible = array();
for ($i = 0; $i < count($times); $i++) {
	$totalTime = $times[$i];
	$distanceRequired = $distances[$i];

	$totalPossible = 0;
	for ($holdTime = 0; $holdTime <= $totalTime; $holdTime++) {
		$moveTime = $totalTime - $holdTime;
		$moveDistance = $holdTime * $moveTime;

		if ($moveDistance > $distanceRequired) {
			$totalPossible++;
		}
		//print("Button held for $moveTime, boat moved: $moveDistance\n");
	}
	print("$totalPossible - possible!\n");
	$totalsPossible[] = $totalPossible;
}

print_r(array_product($totalsPossible));