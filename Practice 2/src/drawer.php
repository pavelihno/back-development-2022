<?php

    header("Content-Type: image/png");

    $input_number = $_GET['num'] ?? 0;
    
    $size_num = $input_number & 3;          // 0-1 бит

    $color_num = ($input_number >> 2) & 3;  // 2-3 бит
    
    $shape_num = ($input_number >> 4) & 3;  // 4-5 бит  

    $img_width = 800;
    $img_height = 600;

    $img = imagecreatetruecolor($img_width, $img_height);

    $colors = [
        imagecolorallocate($img, 255, 255, 255),    // white
        imagecolorallocate($img, 255, 0, 0),        // red
        imagecolorallocate($img, 0, 255, 0),        // green
        imagecolorallocate($img, 0, 0, 255)         // blue
    ];

    $color = $colors[$color_num];
    $size = $size_num + 1;

    if ($shape_num == 0) {
        imagefilledrectangle($img, 0, 0, 150*$size, 100*$size, $color);
    }
    elseif ($shape_num == 1) {
        imagefilledrectangle($img, 0, 0, 150*$size, 150*$size, $color);
    }   
    elseif ($shape_num == 2) {
        imagefilledellipse($img, $img_width/2, $img_height/2, 100*$size, 100*$size, $color);
    } 
    else {
        $points = array(
            $img_width/2, $img_height/2,
            $img_width/2 - 50*$size, $img_height/2 + 50*$size,
            $img_width/2 + 50*$size, $img_height/2 + 50*$size
        );

        imagefilledpolygon($img, $points, $color);
    }

    imagepng($img);

?>

