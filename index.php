<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<form action="clustering.php" method="POST">
			<h1>Multiband Image Clustering - using Single Linkage</h1>
			<b>Jumlah Cluster (K) = </b><input type="text" name="K">

			<input type="submit" name="test" value="Hitung"><br>

			<br><hr>
		</form>
		
		<form>
			<input type="button" value="Gunakan Data yang Ada" onclick="window.location.href='imagecreation.php'" />
		</form>
	</body>
</html>
