<?php
require_once '../../config.php';
 
// Escape user inputs for security
$idEdit = mysqli_real_escape_string($link, $_REQUEST['id']);
$tituloEdit = mysqli_real_escape_string($link, $_REQUEST['titulo']);
$descricaoEdit = mysqli_real_escape_string($link, $_REQUEST['descricao']);
$latEdit = mysqli_real_escape_string($link, $_REQUEST['lat']);
$lngEdit = mysqli_real_escape_string($link, $_REQUEST['lng']);
$hora_aberturaEdit = mysqli_real_escape_string($link, $_REQUEST['hora_abertura']);
$hora_fechamentoEdit = mysqli_real_escape_string($link, $_REQUEST['hora_fechamento']);
// Perform query
$sql = "UPDATE mapa SET titulo='$tituloEdit', descricao='$descricaoEdit', lat='$latEdit', lng='$lngEdit', hora_abertura='$hora_aberturaEdit', hora_fechamento='$hora_fechamentoEdit' WHERE id='$idEdit'";
// Return status
if(mysqli_query($link, $sql)){
    echo "200";
} else{
    echo "ERROR: Unable to execute $sql. " . mysqli_error($link);
}
// close connections
mysqli_close($link);
?>