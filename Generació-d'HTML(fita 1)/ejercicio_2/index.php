<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Generació HTML</title>
</head>
<body>
	<h1>EJERCICI 2</h1>

	<table border="1">
		<tr>
			<?php
			$letras = ["A","B","C","D","E","F","G","H","I","J","K"];



			//for ($i = 0; $i < sizeof($letras); $i++){
			//	echo "<tr><td>"  . $letras[$i] . "</td><td>" . $i . "</td></tr>";
				
			//}

			foreach ($letras as $letra) {
				echo "<td>"	. $letra . "</td>";
			}
			echo "<tr>";
			foreach ($letras as $i => $letra){
				echo "<td>"	. $i . "</td>";
			}

			?>
		</tr>
			
	</table>
</body>
</html>

