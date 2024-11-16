<?php

require_once 'shared.php';

$fd = file_get_contents('input-01.txt');
$lines = explode("\n", $fd);

$times_str = str_replace(' ', '', trim($lines[0]));
$distances_str = str_replace(' ', '', trim($lines[1]));

$times = array(explode(':', $times_str)[1]);
$distances = array(explode(':', $distances_str)[1]);

print(part6($times, $distances)[0]);