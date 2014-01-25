<?php

// korisnički upit
$rows = $_POST["rows"];
$columns = $_POST["columns"];

if ($rows <= 0 and $columns <= 0) {
	echo "Invalid number of rows and columns";	
} elseif ($rows <= 0) {
	echo "Invalid number of rows";	
} elseif ($columns <= 0) {
	echo "Invalid number of columns";
} else {
	calculate();
}

function calculate() {
	// globalne varijable
	global $rows;
	global $columns;
	// kreiram tablicu
	$table = array();
	for ($i = 1; $i <= $rows; $i++) {
		array_push($table, array());
		for ($k = 1; $k <= $columns; $k++) {
			array_push($table[$i-1], "X");
		}
	}
	
	// brojači
	$count = 1;
	$count_left = 0;
	$count_up = 0;
	$count_right = 0;
	$count_down = 0;
	$max_count = $rows * $columns;
	
	// glavna petlja
	while ($count <= $max_count) {
		// idem lijevo
		for ($i = 1; $i <= $columns-$count_up-$count_down; $i++) {
			$table[$rows-1-$count_left][$columns-$i-$count_down] = $count;
			$count++;
		}
		$count_left++;
		if ($count > $max_count) {
			break;
			}
		// idem gore
		for ($i = 1; $i <= $rows-$count_left-$count_right; $i++) {
			$table[$rows-$count_left-$i][$columns-$columns+$count_up] = $count;
			$count++;
		}
		$count_up++;
		if ($count > $max_count) {
			break;
			}
		// idem desno
		for ($i = 1; $i <= $columns-$count_up-$count_down; $i++) {
			$table[$rows-$rows+$count_right][$columns-$columns-1+$i+$count_left] = $count;
			$count++;
		}
		$count_right++;
		if ($count > $max_count) {
			break;
			}
		// idem dolje
		for ($i = 1; $i <= $rows-$count_left-$count_right; $i++) {
			$table[$rows-$rows-1+$i+$count_up][$columns-1-$count_down] = $count;
			$count++;
		}
		$count_down++;
		if ($count > $max_count) {
			break;
			}
	}
	// ispis tablice
	echo "<table border='4'>";
	for ($i = 1; $i <= $rows; $i++) {
		echo("<tr>");
		for ($k = 1; $k <= $columns; $k++) {
			echo("<td>" . $table[$i-1][$k-1] . "</td>");
		}
	}
}
?>