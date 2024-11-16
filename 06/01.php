<?php

require_once("shared.php");

$fd = file_get_contents('input-01.txt');
$lines = explode("\n", $fd);

$times_str = trim($lines[0]);
$distances_str = trim($lines[1]);

$times = preg_split('/\s+/', $times_str);
$distances = preg_split('/\s+/', $distances_str);
array_splice($times, 0, 1);
array_splice($distances, 0, 1);

$result = array_product(part6($times, $distances));

print("\nAnswer: $result");
