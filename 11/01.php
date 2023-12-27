<?php

$lines = file('input.txt');

require_once 'shared.php';
require_once 'space.class.php';

$matrix = makeMatrixFromFile($lines);
$space = new Space($matrix);

$space->expandSpace();
$space->findGalaxies();

// $space->findDistance(1,7);
// $space->findDistance(3,6);
// $space->findDistance(8,9);

$galaxies = $space->getGalaxyList();

