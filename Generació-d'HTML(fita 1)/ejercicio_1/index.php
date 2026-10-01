<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Generació HTML</title>
</head>
<body>
	<h1>EJERCICI 1</h1>
	<table border="1">
		<tr>
			<?php
			
			for ($i = 0; $i <= 10; $i++){
				echo "<td>" . "$i" . " " . "</td>";
			}
			?>
		</tr>
</table>
</body>
</html>



