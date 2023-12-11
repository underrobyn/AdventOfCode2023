<?php

DEFINE("DEBUG", false);

require_once("shared.php");

$games = gamesFromInputFile("input.txt");

if (DEBUG) print_r($games);

// Filter out impossible game IDs
$possibleGameIds = array();

foreach ($games as $gameId=>$gameData) {
	$gamePossible = true;
	foreach ($gameData as $gameDataValues) {
		if ($gameDataValues["red"] > 12) {
			$gamePossible = false;
			break;
		}
		
		if ($gameDataValues["green"] > 13) {
			$gamePossible = false;
			break;
		}
		
		if ($gameDataValues["blue"] > 14) {
			$gamePossible = false;
			break;
		}
	}
	
	if ($gamePossible) $possibleGameIds[] = $gameId;
}

if (DEBUG) print_r($possibleGameIds);

print_r(array_sum($possibleGameIds));