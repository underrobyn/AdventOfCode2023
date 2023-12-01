<?php

// Get file contents
$fc = file_get_contents('input.txt');

//print($fc);

$char_list = str_split($fc);

$char_map = array(
	"zer" => "0",
	"one" => "1",
	"two" => "2",
	"thr" => "3",
	"fou" => "4",
	"fiv" => "5",
	"six" => "6",
	"sev" => "7",
	"eig" => "8",
	"nin" => "9"
);

$new_string = "";

for ($i = 2; $i < count($char_list); $i++) {
	//print("$i {$char_list[$i]}: " . (string) ord($char_list[$i]) . "\n");
	
	// If int, continue
	if (in_array($char_list[$i], array_values($char_map))) {
		$new_string .= $char_list[$i];
		continue;
	}
	
	$key = $char_list[$i-2] . $char_list[$i-1] . $char_list[$i];
	if (array_key_exists($key, $char_map)) {
		$new_string .= $char_map[$key];
	}
	
	// CR is code 13
	// LF is code 10
	if (ord($char_list[$i]) === 10) {
		$new_string .= "\n";
	}
}

//print($new_string);

// Get array of all line totals
$line_totals = array();

$old_lines = explode("\n", $fc);
$new_lines = explode("\n", $new_string);

if (count($old_lines) !== count($new_lines)){
	die('ERROR');
}

foreach ($old_lines as $i => $line) {
	$old = str_replace("\r", '', $old_lines[$i]);
	$new = str_replace(PHP_EOL, '', $new_lines[$i]);
	print("{$old} -> {$new}\n");
}

foreach ($new_lines as $line) {
	// Remove all characters that aren't integers
	$line_digits = preg_replace('/[^0-9]/', '', $line);
	
	$first = $line_digits[0];
	$last = $line_digits[strlen($line_digits) - 1];
	
	//print("$first $last \n");
	
	$line_totals[] = (int) "{$first}{$last}";
}

print_r(array_sum($line_totals));