<?php
require_once 'config.php';
 
// Escape user inputs for security
$id = mysqli_real_escape_string($link, $_REQUEST['id']);
$titulo = mysqli_real_escape_string($link, $_REQUEST['titulo']);
$descricao = mysqli_real_escape_string($link, $_REQUEST['descricao']);
$lat = mysqli_real_escape_string($link, $_REQUEST['lat']);
$lng = mysqli_real_escape_string($link, $_REQUEST['lng']);
$hora_abertura = mysqli_real_escape_string($link, $_REQUEST['hora_abertura']);
$hora_fechamento = mysqli_real_escape_string($link, $_REQUEST['hora_fechamento']);
// Perform query
$sql = "UPDATE mapa SET titulo='$titulo', descricao='$descricao', lat='$lat', lng='$lng', hora_abertura='$hora_abertura', hora_fechamento='$hora_fechamento' WHERE id='$id'";
// Return status
if(mysqli_query($link, $sql)){
    echo "200";
} else{
    echo "ERROR: Unable to execute $sql. " . mysqli_error($link);
}
// close connections
mysqli_close($link);
?>