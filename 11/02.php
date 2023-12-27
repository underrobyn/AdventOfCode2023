<?php

use drupol\phpermutations\Iterators\Combinations;

$lines = file('input.txt');

require_once 'shared.php';
require_once 'space.class.php';
require_once '../vendor/autoload.php';

$matrix = makeMatrixFromFile($lines);
$space = new Space($matrix);

$space->expandSpace(1000);
$space->findGalaxies();

$galaxies = $space->getGalaxyList();
$galaxyIDs = array_keys($galaxies);
print_r($galaxyIDs);

$galaxyCombinations = (new Combinations($galaxyIDs, 2))->toArray();
$combinationCount = count($galaxyCombinations);

print("There are $combinationCount combinations of galaxy visits");

$totalDist = 0;
foreach ($galaxyCombinations as $combination) {
	$dist = $space->findDistance($combination[0], $combination[1]);
	$totalDist += $dist;
	print("{$combination[0]}, {$combination[1]} -> $dist\n");
}
print_r($totalDist);