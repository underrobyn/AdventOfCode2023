<?php

require_once("shared.php");

$cards = parseScratchcardsFromInput("input.txt");

//print_r($cards);

$totals = array();
foreach ($cards as $cardId=>$card) {
	$intersection = array_intersect($card['winningNumbers'], $card['cardNumbers']);
	$numMatches = count($intersection);
	$score = $numMatches === 0 ? 0 : pow(2, $numMatches-1);
	
	print_r("$cardId has $numMatches, score of $score\n");
	
	$totals[] = $score;
}

print_r(array_sum($totals));