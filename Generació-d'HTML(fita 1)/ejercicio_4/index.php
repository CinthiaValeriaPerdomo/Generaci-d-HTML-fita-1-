<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Generació HTML</title>
</head>
<body>
	<h1>EJERCICI 4</h1>


	<table border="1">
		<?php
		$letras = ["A","B","C","D","E","F","G","H","I","J","K"];
		$n = 10;

		echo "<tr><td></td>";
		for ($col = 1; $col <= $n; $col++){
			echo "<td>" . $col . "</td>";
		}

		echo "<tr>";

		foreach ($letras as $letra) {
			echo "<td>" . $letra . "</td>";
			for ($col = 1; $col <= $n; $col++){
				echo "<td></td>";
			}
			echo "<tr>";
		}

		?>
	</table>
</body>
</html>



