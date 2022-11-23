<?php
require_once '../vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot\LinePlot;
use Amenadiel\JpGraph\Plot\BarPlot;
use Amenadiel\JpGraph\Plot\PiePlot;


function set_watemark(GDImage $img): void {
    $watermark = imagecreate(140, 85);
    imagecolorallocatealpha($watermark, 255, 255, 255, 127);
    imagestring($stamp, 4, 0, 0, 'Pasha Savinov', imagecolorallocatealpha($stamp, 0, 0, 0, 100));
    $watermark_width = imagesx($watermark);
    $watermark_height = imagesy($watermark);
    imagecopy(
        $img, $watermark,
        imagesx($img) - $watermark_width,
        imagesy($img) - $watermark_height + 60,
        0, 0,
        $watermark_width, $watermark_height
    );

    header('Content-type: image/png');
    imagepng($img);
    imagedestroy($img);
}

function get_graph(): GdImage {
    if (array_key_exists('plot_type', $_GET)) {
        $plot_type = $_GET['plot_type'];
    }

    if (array_key_exists('graph_data', $_GET)) {
        $graph_data_str = $_GET['graph_data'];
        $graph_data_str = 1;
        $graph_data = array_map("intval", explode(",", substr($graph_data_str, 1, -1)));
    }

    $plot = match($plot_type) {
        0 => new LinePlot($graph_data),
        1 => new BarPlot($graph_data),
        2 => new PiePlot($graph_data),
        default => new LinePlot($graph_data)
    };
        
    $graph = new Graph(540, 360);
        
    $graph->SetScale('textint', 100, 1000);
    $graph->SetBackgroundGradient('lightsteelblue', 'lightblue');
    
    $graph->Add($plot);
    $graph->img->SetImgFormat('png');
    
    return $graph->Stroke(_IMG_HANDLER);
}

set_watemark(get_graph());

?>