<?php
$connection_string = "host=localhost port=5433 dbname=Simp user=postgres password=3315278732Mn";
$con = pg_connect($connection_string);

$mensaje_crud = "";

if (isset($_POST['accion']) && $_POST['accion'] == 'crear') {
    $nombre = pg_escape_string($con, $_POST['nombre']); 
    $tipo = pg_escape_string($con, $_POST['tipo']);
    $edad = (int)$_POST['edad'];
}

$query = "SELECT id, nombre, tipo, edad FROM public.mascotas";
$resultado = pg_query($con, $query);

?>