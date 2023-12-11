<?php

function gamesFromInputFile(string $inputFile): array {
	// Parse game input
	$input = file_get_contents($inputFile);

	// Split file input into lines by newline character
	$gameLines = explode("\n", $input);

	$games = array();
	foreach ($gameLines as $gameLine) {
		$gameParts = explode(":", $gameLine);
		$gameId = substr($gameParts[0], 5); // Remove "Game "
		
		$gamesPlayed = explode(";", $gameParts[1]);
		$gameResults = array();
		foreach ($gamesPlayed as $gamePlayed) {
			$countersRevealed = explode(",", $gamePlayed);
			
			// Initialise counters for the games to 0
			$counters = array(
				"red"=>0,
				"green"=>0,
				"blue"=>0
			);
			
			foreach ($countersRevealed as $counterRevealed) {
				$value = (int)filter_var($counterRevealed, FILTER_SANITIZE_NUMBER_INT);
				if (str_contains($counterRevealed, "red")) $counters["red"] = $value;
				if (str_contains($counterRevealed, "green")) $counters["green"] = $value;
				if (str_contains($counterRevealed, "blue")) $counters["blue"] = $value;
			}
			
			$gameResults[] = $counters;
		}
		
		$games[$gameId] = $gameResults;
	}
	
	return $games;
}
