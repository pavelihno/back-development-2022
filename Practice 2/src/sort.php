<html lang="en">
<head>
<title>Sorting</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>

<h1>Сортировка</h1>

<div class="sorted-block" style="margin-left: 1%;">
    
<?php

    function mergeSort(array $array) {
        $count = count($array);
        if ($count <= 1)
            return $array;

        $left  = array_slice($array, 0, (int)($count/2));
        $right = array_slice($array, (int)($count/2));

        $left = mergeSort($left);
        $right = mergeSort($right);

        $sorted_array = array();
        while (count($left) > 0 && count($right) > 0) {
            if ($left[0] < $right[0])
                array_push($sorted_array, array_shift($left));
            else
                array_push($sorted_array, array_shift($right));
        }
     
        array_splice($sorted_array, count($sorted_array), 0, $left);
        array_splice($sorted_array, count($sorted_array), 0, $right);
     
        return $sorted_array;
    }

    if (array_key_exists('array', $_GET)) {
        $array = explode(',', $_GET['array']); 
        
        $sorted_array = mergeSort($array);
        
        foreach($sorted_array as $number) {
            echo "<span style='font-size: 150%;'>{$number}</span>";
        }
    }
   
?>

</div>

</body>
</html>