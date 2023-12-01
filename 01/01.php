<?php

// Get file contents
$fc = file_get_contents('input.txt');

// Get array of all line totals
$line_totals = array();
$file_lines = explode("\n", $fc);

foreach ($file_lines as $line) {
	// Remove all characters that aren't integers
	$line_digits = preg_replace('/[^0-9]/', '', $line);
	
	$first = $line_digits[0];
	$last = $line_digits[strlen($line_digits) - 1];
	
	print("$first $last \n");
	
	$line_totals[] = (int) "{$first}{$last}";
}

print_r(array_sum($line_totals));