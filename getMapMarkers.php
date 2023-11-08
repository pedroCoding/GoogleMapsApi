<?php
// Include config file
require_once 'config.php';
// Perform query
$sql = "SELECT lat, lng FROM mapa";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        // set array
        $array = array();
        while($row = mysqli_fetch_array($result)){
            $array[] = $row;
        }
        class markerLocation
        {
            public $lat;
            public $lng;
        }
        $parsedResult = array();
        $arrLength = count($array);
        for ($i=0; $i < $arrLength; $i++) {
            $loc = new markerLocation();
            $loc->lat = $array[$i][0];
            $loc->lng = $array[$i][1];
            array_push($parsedResult,$loc);  
        }
        echo json_encode($parsedResult);

        mysqli_free_result($result);

    } else{
        echo "<div class='alert alert-warning' role='alert'>Não foi encontrado esse local no banco de dados!!</div>";
    }
} else{
    echo "ERROR: Incapaz de executar $sql. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>