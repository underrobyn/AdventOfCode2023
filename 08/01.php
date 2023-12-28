<?php

$fd = file_get_contents('input.txt');

$lines = explode("\n", $fd);

$instructions = trim($lines[0]);
$mapping = array();

for ($i = 2; $i < count($lines); $i++) {
	$parts = explode(" = ", trim($lines[$i]));
	$key = $parts[0];

	$values = array_map(function($val) {
		return preg_replace("/[^A-Z]/", '', $val);
	}, explode(", ", $parts[1]));

	$mapping[$key] = $values;
}

$length = strlen($instructions);
$index = 0;
$elementsVisited = 0;
$currentKey = "AAA";

while (true) {
	$instruction = $instructions[$index] === "L" ? 0 : 1;
	$index = ($index + 1) % $length;
	$elementsVisited++;
	$currentKey = $mapping[$currentKey][$instruction];

	print("$elementsVisited: Took path $instruction and got $currentKey\n");
	if ($currentKey === "ZZZ") break;
}

print("$elementsVisited");