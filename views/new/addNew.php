<?php
require_once '../../config.php';
 
// Escape user inputs for security
$titulo = mysqli_real_escape_string($link, $_REQUEST['titulo']);
$descricao = mysqli_real_escape_string($link, $_REQUEST['descricao']);
$lat = mysqli_real_escape_string($link, $_REQUEST['lat']);
$lng = mysqli_real_escape_string($link, $_REQUEST['lng']);
$hora_abertura = mysqli_real_escape_string($link, $_REQUEST['hora_abertura']);
$hora_fechamento = mysqli_real_escape_string($link, $_REQUEST['hora_fechamento']);
// Perform query
$sql = "INSERT INTO mapa (id, titulo, descricao, lat, lng, hora_abertura, hora_fechamento) VALUES (NULL, '$titulo', '$descricao', '$lat', '$lng', '$hora_abertura', '$hora_fechamento')";
// Return status
if(mysqli_query($link, $sql)){
    echo "200";
} else{
    echo "ERROR: Não foi possivel enviar para o Banco. $sql. " . mysqli_error($link);
}
// close connection
mysqli_close($link);
?>