<?php
$connection_string = "host=localhost port=5433 dbname=Simp user=postgres password=3315278732Mn";
$con = pg_connect($connection_string);

$query = "SELECT id, nombre, tipo, edad FROM public.mascotas";
$resultado = pg_query($con, $query);
?>