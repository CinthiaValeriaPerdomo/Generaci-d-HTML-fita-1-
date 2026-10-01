<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Generació HTML</title>
    <style>
        .ej_table {
              border-collapse: collapse;
            }


        .ej_table td {
          border: 1px solid black;
          padding: 10px;
          text-align: center;
        }
    </style>
</head>
<body>
	<h1>EJERCICI 5</h1>
    <table class="ej_table">
        <?php

        $n = 20;
        $m = 7;
        $letters = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

        
        for ($i=0; $i < $m - 1; $i++) { 
            echo "<tr>";

            for ($j = 0; $j < $n - 1; $j++) {
                if ($i % 2 == $j % 2) {
                    echo "<td>X</td>";
                }else{
                    echo "<td></td>";
                }

            }

            echo "<td>$letters[$i]</td>";            

            echo "</tr>";
        }

        echo "<tr>";
        for ($j = 1; $j <= $n - 1; $j++) {
            echo "<td>$j</td>";
        }
        echo "<td>X</td>";
        echo "</tr>";




        ?>


    </table>
</body>
</html>









