<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Batalla Naval - PHP</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
 
<h1>EJERCICIO - Batalla Naval en PHP</h1>
 
<?php
// ---------- Configuración común ----------
$letras = ["A","B","C","D","E","F","G","H","I","J"];
$n = 10; // nº de columnas (y de filas, usamos tantas letras como $n)
 
// Crea una matriz $n x $n llena de "." (agua)
function crearMatrizVacia($n) {
	$m = [];
	for ($f = 0; $f < $n; $f++) {
		$fila = [];
		for ($c = 0; $c < $n; $c++) {
			$fila[] = ".";
		}
		$m[] = $fila;
	}
	return $m;
}
 
function pintarTablero($matriz, $letras, $n) {
	echo "<table border='1'>";
 
	echo "<tr><td></td>";
	for ($col = 1; $col <= $n; $col++) {
		echo "<td>" . $col . "</td>";
	}
	echo "</tr>";
 
	for ($f = 0; $f < count($letras); $f++) {
		echo "<tr>";
		echo "<td>" . $letras[$f] . "</td>";
		for ($col = 0; $col < $n; $col++) {
			$valor = $matriz[$f][$col];
			$clase = ($valor === ".") ? "agua" : $valor;
			$texto = ($valor === ".") ? "" : $valor;
			echo "<td class='" . $clase . "'>" . $texto . "</td>";
		}
		echo "</tr>";
	}
 
	echo "</table>";
}
function celdasDelBarco($barco) {
	$celdas = [];
	for ($i = 0; $i < $barco['longitud']; $i++) {
		if ($barco['orientacion'] === "H") {
			$celdas[] = ["fila" => $barco['fila'], "columna" => $barco['columna'] + $i];
		} else {
			$celdas[] = ["fila" => $barco['fila'] + $i, "columna" => $barco['columna']];
		}
	}
	return $celdas;
}
function generarBarcoAleatorio($longitud, $n) {
	$orientacion = (mt_rand(0, 1) === 0) ? "H" : "V";
 
	if ($orientacion === "H") {
		$fila = mt_rand(0, $n - 1);
		$columna = mt_rand(0, $n - $longitud);
	} else {
		$fila = mt_rand(0, $n - $longitud);
		$columna = mt_rand(0, $n - 1);
	}
 
	return ["fila" => $fila, "columna" => $columna, "orientacion" => $orientacion, "longitud" => $longitud];
}
 
// Comprueba límites
function dentroDeLimites($fila, $columna, $n) {
	return $fila >= 0 && $fila < $n && $columna >= 0 && $columna < $n;
}
 
function posicionValida($matriz, $barco, $n) {
	$celdas = celdasDelBarco($barco);
 
	foreach ($celdas as $celda) {
		if (!dentroDeLimites($celda['fila'], $celda['columna'], $n)) return false;
 
		for ($df = -1; $df <= 1; $df++) {
			for ($dc = -1; $dc <= 1; $dc++) {
				$f = $celda['fila'] + $df;
				$c = $celda['columna'] + $dc;
				if (dentroDeLimites($f, $c, $n) && $matriz[$f][$c] !== ".") {
					return false;
				}
			}
		}
	}
	return true;
}
 
function colocarBarcoValido(&$matriz, $longitud, $codigo, $n) {
	$intentos = 0;
	do {
		$barco = generarBarcoAleatorio($longitud, $n);
		$intentos++;
		if ($intentos > 2000) {
			throw new Exception("No se encontró hueco para el barco");
		}
	} while (!posicionValida($matriz, $barco, $n));
 
	foreach (celdasDelBarco($barco) as $celda) {
		$matriz[$celda['fila']][$celda['columna']] = $codigo;
	}
}
 
$FLOTA = [
	["codigo" => "F", "longitud" => 1, "cantidad" => 4],
	["codigo" => "S", "longitud" => 2, "cantidad" => 3],
	["codigo" => "D", "longitud" => 3, "cantidad" => 2],
	["codigo" => "P", "longitud" => 4, "cantidad" => 1],
];
?>
 
<!-- EJERCICIO 1: tablero base -->
<h2>Ejercicio 1: Tablero vacío</h2>
<?php
$matriz1 = crearMatrizVacia($n);
pintarTablero($matriz1, $letras, $n);
?>
 
<!-- EJERCICIO 2: un barco aleatorio -->
<h2>Ejercicio 2: Un submarino aleatorio (recarga la página para verlo cambiar)</h2>
<?php
$matriz2 = crearMatrizVacia($n);
$submarino = generarBarcoAleatorio(2, $n); // longitud 2
foreach (celdasDelBarco($submarino) as $celda) {
	$matriz2[$celda['fila']][$celda['columna']] = "S";
}
pintarTablero($matriz2, $letras, $n);
?>
 
<!-- EJERCICIO 4: partida fija, un barco de cada tipo -->
<h2>Ejercicio 4: Un barco de cada tipo (posiciones fijas)</h2>
<?php
$matriz4 = crearMatrizVacia($n);
$barcosFijos = [
	["fila" => 0, "columna" => 0, "orientacion" => "H", "longitud" => 1, "codigo" => "F"],
	["fila" => 2, "columna" => 3, "orientacion" => "V", "longitud" => 2, "codigo" => "S"],
	["fila" => 5, "columna" => 1, "orientacion" => "H", "longitud" => 3, "codigo" => "D"],
	["fila" => 7, "columna" => 6, "orientacion" => "V", "longitud" => 4, "codigo" => "P"],
];
foreach ($barcosFijos as $barco) {
	foreach (celdasDelBarco($barco) as $celda) {
		$matriz4[$celda['fila']][$celda['columna']] = $barco['codigo'];
	}
}
pintarTablero($matriz4, $letras, $n);
?>
 
<!-- EJERCICIO 5: partida aleatoria SIN restricciones -->
<h2>Ejercicio 5: Partida aleatoria completa (puede solaparse o salirse)</h2>
<?php
$matriz5 = crearMatrizVacia($n);
foreach ($FLOTA as $tipo) {
	for ($i = 0; $i < $tipo['cantidad']; $i++) {
		$barco = generarBarcoAleatorio($tipo['longitud'], $n);
		foreach (celdasDelBarco($barco) as $celda) {
			if (dentroDeLimites($celda['fila'], $celda['columna'], $n)) {
				$matriz5[$celda['fila']][$celda['columna']] = $tipo['codigo'];
			}
		}
	}
}
pintarTablero($matriz5, $letras, $n);
?>
 
<!-- EJERCICIO 6: partida aleatoria VÁLIDA -->
<h2>Ejercicio 6: Partida aleatoria válida (sin solapar ni tocarse)</h2>
<?php
$matriz6 = crearMatrizVacia($n);
foreach ($FLOTA as $tipo) {
	for ($i = 0; $i < $tipo['cantidad']; $i++) {
		colocarBarcoValido($matriz6, $tipo['longitud'], $tipo['codigo'], $n);
	}
}
pintarTablero($matriz6, $letras, $n);
?>
 
</body>
</html>