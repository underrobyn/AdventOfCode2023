<?php

$lines = file('input.txt');

require_once 'shared.php';
require_once 'space.class.php';

$matrix = makeMatrixFromFile($lines);
$space = new Space($matrix);

