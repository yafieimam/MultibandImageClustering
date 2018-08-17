<?php

	$file = "data.txt";
	$contents = file_get_contents($file);
	$data = explode("\n", $contents);

	$i=0;
	$dataSet=array();
	
	foreach ($data as $key) {
		$keyData = explode(",", $key);
		
		$dataSet[$i]['id']=$i+1;
		$dataSet[$i]['a']=isset($keyData[0]) ? $keyData[0] : null;
		$dataSet[$i]['b']=isset($keyData[1]) ? $keyData[1] : null;
		$dataSet[$i]['c']=isset($keyData[2]) ? $keyData[2] : null;
		$dataSet[$i]['d']=isset($keyData[3]) ? $keyData[3] : null;
		$dataSet[$i]['e']=isset($keyData[4]) ? $keyData[4] : null;
		$dataSet[$i]['f']=isset($keyData[5]) ? $keyData[5] : null;
		$i++;
	}
	
	for ($n=0; $n < count($dataSet); $n++) { 
		$dataSet[$n]['cluster']=$n+1;
	}
	
	/*
	foreach($dataSet as $value){
		echo $value['id'] . " - ";
		echo $value['a'] . "," . $value['b'] . "," . $value['c'] . "," . $value['d'] . "," . $value['e'] . "," . $value['f'];
		echo "<br>";
	}
	*/
	
	if (isset($_POST['K'])) {
		$i=count($dataSet);
		echo "<h2>Nilai K (Jumlah Cluster) : ".$_POST['K']."</h><hr>";
		while ($i>$_POST['K']) {
			$dis=10000;
			$temp=array();
			$temp1=array();		
			$jarakCluster=array();
			
			for ($j=0; $j < count($dataSet); $j++) {
				for ($k=$j+1; $k < count($dataSet); $k++) {
					$selisihA=$dataSet[$j]['a']-$dataSet[$k]['a'];
					$selisihB=$dataSet[$j]['b']-$dataSet[$k]['b'];
					$selisihC=$dataSet[$j]['c']-$dataSet[$k]['c'];
					$selisihD=$dataSet[$j]['d']-$dataSet[$k]['d'];
					$selisihE=$dataSet[$j]['e']-$dataSet[$k]['e'];
					$selisihF=$dataSet[$j]['f']-$dataSet[$k]['f'];
					$jarak=ceil(sqrt(pow($selisihA,2)+pow($selisihB,2)+pow($selisihC,2)+pow($selisihD,2)+pow($selisihE,2)+pow($selisihF,2)));
					
					if($dis>$jarak && $dataSet[$j]['cluster']!=$dataSet[$k]['cluster']){
						$dis=$jarak;
						$temp=$dataSet[$j];
						$temp1=$dataSet[$k];
					}
				}
			}
			
			for ($n=0; $n < count($dataSet); $n++) { 
				if($dataSet[$n]['cluster'] == $temp1['cluster']){
					$dataSet[$n]['cluster']=$temp['cluster'];
				}
			}
			
			$i--;
		}
		
		
		for($i=0; $i<count($dataSet); $i++){
			$hasil = $dataSet[$i]['id'] . "," . $dataSet[$i]['a'] . "," . $dataSet[$i]['b'] . "," . $dataSet[$i]['c'] . "," . $dataSet[$i]['d'] . "," . $dataSet[$i]['e'] . "," . $dataSet[$i]['f'] . "," . $dataSet[$i]['cluster'];
			$string = $hasil . "\n";
			file_put_contents("hasil_clustering.txt", $string, FILE_APPEND);
		}
		
		
		echo "<h2>Hasil Clustering</h2>";
		$idClusterResult = array();
		for($a=0; $a < count($dataSet); $a++){
			if(!in_array($dataSet[$a]['cluster'], $idClusterResult)){
				array_push($idClusterResult,$dataSet[$a]['cluster']);
			}
		}
		print_r($idClusterResult);
		echo "<br>";
		
		for ($a=0; $a <count($idClusterResult) ; $a++){
			$t=$a+1;
			echo "Data Cluster Ke $t : ";
			for ($b=0; $b <count($dataSet) ; $b++) { 
				if ($dataSet[$b]['cluster']==$idClusterResult[$a]) {
					echo $dataSet[$b]['id'] . " ";
				}
			}
			echo "<br>";
		}
		
		echo "<hr>";
		echo "<h2>Jarak Antar Cluster</h2>";
		$dis=10000;
		for($a=0 ; $a < count($idClusterResult) ; $a++){
			for($b=$a+1 ; $b < count($idClusterResult) ; $b++){
				for($x=0 ; $x < count($dataSet); $x++){
					for($y=$x+1 ; $y < count($dataSet); $y++){
						$selisihA=$dataSet[$j]['a']-$dataSet[$k]['a'];
						$selisihB=$dataSet[$j]['b']-$dataSet[$k]['b'];
						$selisihC=$dataSet[$j]['c']-$dataSet[$k]['c'];
						$selisihD=$dataSet[$j]['d']-$dataSet[$k]['d'];
						$selisihE=$dataSet[$j]['e']-$dataSet[$k]['e'];
						$selisihF=$dataSet[$j]['f']-$dataSet[$k]['f'];
						$jarak=ceil(sqrt(pow($selisihA,2)+pow($selisihB,2)+pow($selisihC,2)+pow($selisihD,2)+pow($selisihE,2)+pow($selisihF,2)));
						if($dataSet[$x]['cluster']==$idClusterResult[$a]){
							if($dataSet[$y]['cluster']==$idClusterResult[$b]){
								if($dis > $jarak && $dataSet[$x]['cluster'] != $dataSet[$y]['cluster'] ){
									$dis=$jarak;
								}
							}
						}
							
					}
				}

				$c1=$a+1;
				$c2=$b+1;
				echo "Jarak Terdekat Antara <b>Cluster </b>";
				echo "<b>$c1</b>";
				echo " Dan <b>Cluster </b>";
				echo "<b>$c2</b>";
				echo " adalah ";		
				echo " <b>$dis </b><br>";
				$dis = 100000;
			}
		}
	}
?>