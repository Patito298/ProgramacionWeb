<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ejercicio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- bootstrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
<h1> BBDD SQLite </h1>

<?php
$nombreBD= "mibase.db";
$ruta = getcwd()."/$nombreBD";
if (!file_exists($ruta)){
$bd = new sqlite3('mibase.db');
echo 'LA BASE FUE CREADA CON ÉXITO <br>';
$bd->exec("CREATE TABLE agenda(id INTEGER PRIMARY KEY AUTOINCREMENT, nombre TEXT, mail TEXT)");
$bd->exec("INSERT INTO agenda VALUES (1,'Jose','jo@hotmail.com')");
$bd->exec("INSERT INTO agenda VALUES (2,'Jose','jo@hotmail.com')");
$bd->exec("INSERT INTO agenda VALUES (3,'Jose','jo@hotmail.com')");
$bd->exec("INSERT INTO agenda VALUES (4,'Jose','jo@hotmail.com')");
$bd->exec("INSERT INTO agenda VALUES (5,'Jose','jo@hotmail.com')");
}else{
echo 'LA BASE YA FUE CREADA CON ANTERIORIDAD <br>';
echo '<br>';
$bd = new sqlite3('mibase.db');
$resultado = $bd->query("SELECT * FROM agenda");
while ($fila = $resultado->fetchArray(SQLITE3_ASSOC)) {
$id=$fila['id'];
$nombre=$fila['nombre'];
echo("$id - $nombre<br/>");
$mail=$fila['mail'];
echo("$id - $mail<br/>");
}
echo '<br>';
echo '<head><meta http-equiv="Content-Type" content="Text/html;charset=UTF-8"></head>';
echo '<table border="1">
<th>ID</th>
<th>Nombre</th>
<th>Email</th>';
while ($fila =$resultado->fetchArray()){
echo"<tr><td>".$fila['id']."</td>
<td>".$fila['nombre']."</td>
<td>".$fila['mail']."</td></tr>";
}
echo '</table>';
echo '<br>';
echo '<br>';
}
$bd->exec("UPDATE agenda SET nombre = 'Carlos II' WHERE id = '4'");
$bd->exec("UPDATE agenda SET nombre = 'Carlos III' WHERE id = '1'");
echo "cambios: ". $bd->changes(). "<br/>";
if(($bd->changes()) < 1){
echo "Actualización Fallida<br/><br/>";
}else{
echo "Actualización CONFIRMADA<br/><br/>";
}
// $bd->exec("DELETE FROM agenda WHERE id = '5'");
$bd->close();
?>
</body>
</html>