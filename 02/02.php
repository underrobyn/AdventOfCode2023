<?php

DEFINE("DEBUG", false);

require_once("shared.php");

$games = gamesFromInputFile("input.txt");

if (DEBUG) print_r($games);


$gameRunningTotal = 0;

foreach ($games as $gameId=>$gameData) {
	$minimumCounters = array(
		"red"=>0,
		"green"=>0,
		"blue"=>0
	);
	
	// Get largest number of each counter type seen in a game
	foreach ($gameData as $gameDataValues) {
		if ($gameDataValues["red"] > $minimumCounters["red"]) $minimumCounters["red"] = $gameDataValues["red"];
		if ($gameDataValues["green"] > $minimumCounters["green"]) $minimumCounters["green"] = $gameDataValues["green"];
		if ($gameDataValues["blue"] > $minimumCounters["blue"]) $minimumCounters["blue"] = $gameDataValues["blue"];
	}
	
	if (DEBUG) print_r($minimumCounters);
	
	$countersCubed = array_product(array_values($minimumCounters));
	if (DEBUG) print_r($countersCubed);
	
	$gameRunningTotal += $countersCubed;
}

print_r($gameRunningTotal);