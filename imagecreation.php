<?php

	$file = file_get_contents("hasil_clustering.txt");
	$data = explode("\n", $file);
	
	$i = 0;
	$data_cluster = array();
	foreach($data as $row => $value){
		$keyData = explode(",", $value);
		$data_cluster[$i] = $keyData[7];
		$i++;
	}
	
	$file_data = file_get_contents("data.txt");
	$data_pixel = explode("\n", $file_data);

	$i=0;
	$dataSet=array();
	foreach ($data_pixel as $key) {
		$dataKey = explode(",", $key);
		
		$dataSet[$i]['a']=isset($dataKey[0]) ? $dataKey[0] : null;
		$dataSet[$i]['b']=isset($dataKey[1]) ? $dataKey[1] : null;
		$dataSet[$i]['c']=isset($dataKey[2]) ? $dataKey[2] : null;
		$dataSet[$i]['d']=isset($dataKey[3]) ? $dataKey[3] : null;
		$dataSet[$i]['e']=isset($dataKey[4]) ? $dataKey[4] : null;
		$dataSet[$i]['f']=isset($dataKey[5]) ? $dataKey[5] : null;
		$i++;
	}
	
	$pixels = array();
	for($y=0; $y<32; $y++){
		for($x=0; $x<32; $x++){
			$pixels[$y][$x] = $data_cluster[$x+($y*32)];
			$hasil = $dataSet[$x+($y*32)]['a'] . "," . $dataSet[$x+($y*32)]['b'] . "," . $dataSet[$x+($y*32)]['c'] . "," . $dataSet[$x+($y*32)]['d'] . "," . $dataSet[$x+($y*32)]['e'] . "," . $dataSet[$x+($y*32)]['f'] . "," . $pixels[$y][$x];
			$string = $hasil . "\n";
			//file_put_contents("data_final.txt", $string, FILE_APPEND);
		}
	}
	
	$gambar = imagecreatetruecolor(32, 32);
	$warna1 = imagecolorallocate($gambar, 46, 204, 113); //hijau laut
	$warna2 = imagecolorallocate($gambar, 52, 152, 219); //biru laut
	$warna3 = imagecolorallocate($gambar, 46, 204, 113); //hijau muda
	$warna4 = imagecolorallocate($gambar, 236, 240, 241); //putih awan
	$warna5 = imagecolorallocate($gambar, 241, 196, 15); //kuning tua
	$warna6 = imagecolorallocate($gambar, 231, 76, 60); //merah
	
	//image creation
	for($y=0; $y<32; $y++){
		for($x=0; $x<32; $x++){
			if($pixels[$y][$x] == 538){
				imagesetpixel($gambar, $x, $y, $warna2);
			}else if($pixels[$y][$x] == 266){
				imagesetpixel($gambar, $x, $y, $warna3);
			}else if($pixels[$y][$x] == 507){
				imagesetpixel($gambar, $x, $y, $warna4);
			}else if($pixels[$y][$x] == 386){
				imagesetpixel($gambar, $x, $y, $warna6);
			}
		}
	}
	
	header('Content-Type: image/png');
	imagepng($gambar);
?>