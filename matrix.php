<?php

$rows = 10;
$cols = 10;
$eights = 22;

$matrix = [];
for ($y = 1; $y <= $rows; $y++) {
    for ($x = 1; $x <= $cols; $x++) {
        $matrix[$x][$y] = 0;
    }
}

for ($i = 0; $i < $eights; $i++) {
    $randomX = rand(1, $cols);
    $randomY = rand(1, $rows);

    if ($matrix[$randomX][$randomY] != 0) {
        if (false === haveFeePlace($matrix)) {
            break;
        }
        $i--;
    } else {
        // -1
        if (isset($matrix[$randomX-1][$randomY])) {
            $matrix[$randomX-1][$randomY]++;
        }
        if (isset($matrix[$randomX-1][$randomY+1])) {
            $matrix[$randomX-1][$randomY+1]++;
        }
        if (isset($matrix[$randomX-1][$randomY-1])) {
            $matrix[$randomX-1][$randomY-1]++;
        }

        // 0
        $matrix[$randomX][$randomY] = 8;
        if (isset($matrix[$randomX][$randomY+1])) {
            $matrix[$randomX][$randomY+1]++;
        }
        if (isset($matrix[$randomX][$randomY-1])) {
            $matrix[$randomX][$randomY-1]++;
        }

        // +1
        if (isset($matrix[$randomX+1][$randomY])) {
            $matrix[$randomX+1][$randomY]++;
        }
        if (isset($matrix[$randomX+1][$randomY+1])) {
            $matrix[$randomX+1][$randomY+1]++;
        }
        if (isset($matrix[$randomX+1][$randomY-1])) {
            $matrix[$randomX+1][$randomY-1]++;
        }
    }
}

if ($i < $eights) {
    echo "Only {$i} eights added...\n\r";
}

$colors = [
    0 => "\e[37m%s\e[0m",
    1 => "\e[34m%s\e[0m",
    2 => "\e[32m%s\e[0m",
    3 => "\e[33m%s\e[0m",
    4 => "\e[35m%s\e[0m",
    8 => "\e[31m%s\e[0m",
];
foreach ($matrix as $row) {
    foreach ($row as $item) {
        $color = isset($colors[$item]) ? $colors[$item] : $colors[0];
        echo sprintf($color, $item) . " ";
    }

    echo "\n\r";
}

function haveFeePlace(array $data) {
    foreach ($data as $item) {
        if (array_search(0, $item)) {
            return true;
        }
    }

    return false;
}
