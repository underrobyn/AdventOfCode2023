<?php

function makeMatrixFromFile($lines): array {
	$matrix = array();
	$matrixSize = 10;

	foreach($lines as $line) {
		$matrix[] = str_split(trim($line));

		// Check that the last added item had correct length
		if (count(end($matrix)) !== $matrixSize) {
			print_r($matrix);
			die('matrix cannot be re-sized');
		}
	}

	return $matrix;
}
