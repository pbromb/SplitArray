<?php

require 'SplitArray.php';

$columns = 4;
$separationSize = 1;

// textarea to array
$textArray = preg_split("/\\r\\n|\\r|\\n/", filter_input(INPUT_POST, 'text'));

$arr = [];
$i = 0;
foreach ($textArray as $val) {
    if($val === '') {
        $i++;
        continue;
    }
   $arr[$i][] = $val;
}

// convert
$output = SplitArray::div($arr, $columns, $separationSize);

// output
for ($x = 0; $x < count($output); $x++) {

    echo '<table border="1" style="float: left;">';
    foreach ($output[$x] as $val) {
        foreach ($val as $i) {
            echo '<tr> <td>' . $i . '</td> </tr>';
        }
        if ($val !== end($output[$x])) {
            echo '<tr> <td>&nbsp; </td> </tr>';
        }
    }
    echo '</table>';
    
}
