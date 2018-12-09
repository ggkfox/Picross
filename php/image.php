<?php 
//header("Location: ../title.php")
//$size_matrix = (isset($_GET["size"])) ? $_GET["size"] : '7';
$size_matrix = $_GET["size"];
$source_file = "../boards/board1.jpg";

$im = imagecreatefromjpeg($source_file); 
$imgw = imagesx($im);
$imgh = imagesy($im);

$size_cellw=floor($imgw/$size_matrix);
$size_cellh=floor($imgh/$size_matrix);

$map = [];
for ($i=0; $i<$imgw; $i++) {
	    $map[$i] = [];
        for ($j=0; $j<$imgh; $j++) {      
                // get the rgb value for current pixel
                $rgb = ImageColorAt($im,$i,$j);        
                // extract each value for R, G, B (RED, GREEN, BLUE)     
                $rr = ($rgb >> 16) & 0xFF;
                $gg = ($rgb >> 8) & 0xFF;
                $bb = $rgb & 0xFF;  
                // get the Value from the RGB value
                $g = round(($rr + $gg + $bb) / 3);
                // Grayscale values have r=g=b=g (just the average of the 3 channels)
                $val = imagecolorallocate($im, $g, $g, $g);
				$map[$i][$j]=floor($g);
                // set the gray value
                imagesetpixel($im, $i, $j, $val);
        }
}

// Part 1: Create a matrix of size n x n that contains in each cell the average of the values in map of the corresponding area in the image
$map_resize = [];
for ($i=0;$i<$size_matrix;$i++) {
	$map_resize[$i] = [];
	for ($j=0;$j<$size_matrix;$j++) {	
		$s=0;
		for ($i1=0;$i1<$size_cellw;$i1++)
			for ($j1=0;$j1<$size_cellh;$j1++) { 
			$s=$s+$map[$i*$size_cellw+$i1][$j*$size_cellh+$j1];	
			}
		$s=$s/($size_cellh*$size_cellw);
		$map_resize[$i][$j]=$s;	
	}
}
// Part 2: Consider a global threshold to transform the matrix with gray values into binary values
$map_binary = [];
for ($i=0;$i<$size_matrix;$i++) {
	$map_binary[$i] = [];
	for ($j=0;$j<$size_matrix;$j++) {
		if ($map_resize[$i][$j]<128)
			$map_binary[$i][$j]=1;
		else
			$map_binary[$i][$j]=0;
	}
}

// change orientation of image
$rotated = [];
for ($i=0;$i<$size_matrix;$i++) {
	$rotated[$i] = [];
	for ($j=0;$j<$size_matrix;$j++)
		$rotated[$i][$j] = $map_binary[$size_matrix-$j-1][$i];

}

// send grid cordinates
echo "\"";
echo json_encode($rotated);
echo "\"";


/*
echo 'Image of size '. $imgw .' x '. $imgh .'<br>';
echo 'Cells of size '. $size_cellw .' x '. $size_cellh .'<br>';

echo '<TABLE STYLE="border-collapse: collapse;">';
for ($i=0;$i<$size_matrix;$i++) {
	echo '<TR>';
	for ($j=0;$j<$size_matrix;$j++)
		echo '<TD>'. $map_binary[$i][$j] . '<TD>';
	echo '<TR>';
}
echo '</TABLE>';
*/

?>