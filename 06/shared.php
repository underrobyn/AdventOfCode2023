<?php

function part6($times, $distances) {
	$num_ways_to_win = [];
	for ($i = 0; $i < count($times); $i++) {
		print("Race {$i} lasts {$times[$i]} milliseconds. The record distance in this race is {$distances[$i]} millimeters.\n");

		$ways_to_win = 0;
		for ($t = 0; $t <= $times[$i]; $t++) {
			$distance_travelled = $t * ($times[$i] - $t);
			#print("\nDistance travelled {$distance_travelled} millimeters");

			if ($distance_travelled > $distances[$i]) {
				#print(" - We beat them");
				$ways_to_win++;
			}
		}
		$num_ways_to_win[] = $ways_to_win;
	}

	return $num_ways_to_win;
}