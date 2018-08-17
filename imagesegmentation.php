<?php

$image1 = imagecreatefromgif("gb1.GIF");
$image2 = imagecreatefromgif("gb2.GIF");
$image3 = imagecreatefromgif("gb3.GIF");
$image4 = imagecreatefromgif("gb4.GIF");
$image5 = imagecreatefromgif("gb5.GIF");
$image6 = imagecreatefromgif("gb7.GIF");

imagefilter($image1, IMG_FILTER_GRAYSCALE);
imagefilter($image2, IMG_FILTER_GRAYSCALE);
imagefilter($image3, IMG_FILTER_GRAYSCALE);
imagefilter($image4, IMG_FILTER_GRAYSCALE);
imagefilter($image5, IMG_FILTER_GRAYSCALE);
imagefilter($image6, IMG_FILTER_GRAYSCALE);

for($y = 0; $y < 32; $y++){
	for($x = 0; $x < 32; $x++){
		$rgb_image1 = imagecolorat($image1, $x, $y);
		$rgb_image2 = imagecolorat($image2, $x, $y);
		$rgb_image3 = imagecolorat($image3, $x, $y);
		$rgb_image4 = imagecolorat($image4, $x, $y);
		$rgb_image5 = imagecolorat($image5, $x, $y);
		$rgb_image6 = imagecolorat($image6, $x, $y);
		
		$r_image1 = ($rgb_image1 >> 16) & 0xFF;
		$g_image1 = ($rgb_image1 >> 8) & 0xFF;
		$b_image1 = $rgb_image1 & 0xFF;
		
		$r_image2 = ($rgb_image2 >> 16) & 0xFF;
		$g_image2 = ($rgb_image2 >> 8) & 0xFF;
		$b_image2 = $rgb_image2 & 0xFF;
		
		$r_image3 = ($rgb_image3 >> 16) & 0xFF;
		$g_image3 = ($rgb_image3 >> 8) & 0xFF;
		$b_image3 = $rgb_image3 & 0xFF;
		
		$r_image4 = ($rgb_image4 >> 16) & 0xFF;
		$g_image4 = ($rgb_image4 >> 8) & 0xFF;
		$b_image4 = $rgb_image4 & 0xFF;
		
		$r_image5 = ($rgb_image5 >> 16) & 0xFF;
		$g_image5 = ($rgb_image5 >> 8) & 0xFF;
		$b_image5 = $rgb_image5 & 0xFF;
		
		$r_image6 = ($rgb_image6 >> 16) & 0xFF;
		$g_image6 = ($rgb_image6 >> 8) & 0xFF;
		$b_image6 = $rgb_image6 & 0xFF;
		
		$gray_image1 = round(.299 * $r_image1 + .587 * $g_image1 + .114 * $b_image1);
		$gray_image2 = round(.299 * $r_image2 + .587 * $g_image2 + .114 * $b_image2);
		$gray_image3 = round(.299 * $r_image3 + .587 * $g_image3 + .114 * $b_image3);
		$gray_image4 = round(.299 * $r_image4 + .587 * $g_image4 + .114 * $b_image4);
		$gray_image5 = round(.299 * $r_image5 + .587 * $g_image5 + .114 * $b_image5);
		$gray_image6 = round(.299 * $r_image6 + .587 * $g_image6 + .114 * $b_image6);
		
		echo $gray_image1 . ", " . $gray_image2 . ", " . $gray_image3 . ", " . $gray_image4 . ", " . $gray_image5 . ", " . $gray_image6;
		echo "<br>";
		$hasil = $gray_image1 . "," . $gray_image2 . "," . $gray_image3 . "," . $gray_image4 . "," . $gray_image5 . "," . $gray_image6;
		$string = $hasil . "\n";
		file_put_contents("data.txt", $string, FILE_APPEND);
	}
}

?>