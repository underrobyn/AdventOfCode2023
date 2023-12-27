<?php

function makeMatrixFromFile($lines): array {
	$matrix = array();
	$matrixSize = 0;

	foreach($lines as $lineID=>$line) {
		$matrix[] = str_split(trim($line));

		// Check that the last added item had correct length
		if ($matrixSize !== 0 && count(end($matrix)) !== $matrixSize) {
			print_r($matrix);
			die("matrix cannot be re-sized {$lineID}");
		}
	}

	return $matrix;
}
