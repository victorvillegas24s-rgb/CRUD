<?php
$connection_string = "host=localhost port=5433 dbname=Simp user=postgres password=3315278732Mn";
$con = pg_connect($connection_string);

$mensaje_crud = "";

if (isset($_POST['accion']) && $_POST['accion'] == 'crear') {
    $nombre = pg_escape_string($con, $_POST['nombre']); 
    $tipo = pg_escape_string($con, $_POST['tipo']);
    $edad = (int)$_POST['edad'];

    $query_insert = "INSERT INTO public.mascotas (nombre, tipo, edad) VALUES ('$nombre', '$tipo', $edad)";
    pg_query($con, $query_insert);

}

if (isset($_GET['id'])) {
    $id_a_eliminar = (int)$_GET['id'];
    $query_delete = "DELETE FROM public.mascotas WHERE id = $id_a_eliminar";
    pg_query($con, $query_delete);

}

if (isset($_POST['id']) && $_POST['accion'] == 'actualizar') {
    $id_a_actualizar = (int)$_POST['id'];
    $nombre_nuevo = pg_escape_string($con, $_POST['nombre']);

}

$query = "SELECT id, nombre, tipo, edad FROM public.mascotas";
$resultado = pg_query($con, $query);

?>