<?php

$fd = file_get_contents('input-01.txt');
$lines = explode("\n", $fd);

$times_str = trim($lines[0]);
$distances_str = trim($lines[1]);

$times = preg_split('/\s+/', $times_str);
$distances = preg_split('/\s+/', $distances_str);
array_splice($times, 0, 1);
array_splice($distances, 0, 1);

$num_ways_to_win = [];
for ($i = 0; $i < count($times); $i++) {
	print("Race {$i} lasts {$times[$i]} milliseconds. The record distance in this race is {$distances[$i]} millimeters.\n");

	$ways_to_win = 0;
	for ($t = 0; $t <= $times[$i]; $t++) {
		$distance_travelled = $t * ($times[$i] - $t);
		print("\nDistance travelled {$distance_travelled} millimeters");

		if ($distance_travelled > $distances[$i]) {
			print(" - We beat them");
			$ways_to_win++;
		}
	}
	$num_ways_to_win[] = $ways_to_win;
}

print(array_product($num_ways_to_win));
