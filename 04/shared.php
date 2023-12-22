<?php

function parseScratchcardsFromInput(string $fileName): array {
	$input = file_get_contents($fileName);
	
	// Split file input into lines by newline character
	$cardLines = explode("\n", $input);
	
	$cards = array();
	foreach ($cardLines as $cardLine) {
		// To remove any pesky \r characters
		$cleanLine = trim($cardLine);
		
		$cardParts = explode(":", $cleanLine);
		$cardId = trim(substr($cardParts[0], 5)); // Remove "Card "
		
		$cardPartition = explode("|", $cardParts[1]);
		
		// Create arrays from the two strings, removing empty array values
		$winningNumbers = array_values(array_filter(explode(" ", $cardPartition[0])));
		$cardNumbers = array_values(array_filter(explode(" ", $cardPartition[1])));
		
		// Create nice and easy to work with arrays
		$cards[$cardId] = array(
			"winningNumbers" => $winningNumbers,
			"cardNumbers" => $cardNumbers
		);
	}
	
	return $cards;
}