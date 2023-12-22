<?php

require_once("shared.php");

$cards = parseScratchcardsFromInput("input.txt");

//print_r($cards);

$matches = array();
$cardCount = array();
foreach ($cards as $cardId=>$card) {
	$intersection = array_intersect($card['winningNumbers'], $card['cardNumbers']);
	$numMatches = count($intersection);
	$score = $numMatches === 0 ? 0 : pow(2, $numMatches-1);
	
	print_r("$cardId has $numMatches, score of $score\n");
	
	$matches[$cardId] = $numMatches;
	$cardCount[$cardId] = 1;
}

$cardCountNew = $cardCount;
$totalCards = 0;
foreach ($matches as $cardId=>$matchCount) {
	print("You had {$cardCount[$cardId]} (now have $cardCountNew[$cardId]) of card ID: $cardId, which has score $matchCount\n");

	for ($j = 1; $j <= $cardCountNew[$cardId]; $j++) {
		for ($i = 1; $i <= $matchCount; $i++) {
			if (count($matches)+1 === $cardId+$i) {
				print("skipping bc we reached the end\n");
				continue;
			}
			//print("\t - Increasing " . $cardId+$i . " by 1\n");
			$index = $cardId+$i;
			$cardCountNew[$index]++;
		}
	}

	$totalCards += $cardCountNew[$cardId];
}

print("Total: $totalCards");