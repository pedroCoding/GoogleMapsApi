<?php
require_once '../../config.php';
// Perform query
$sql = "SELECT * FROM mapa ORDER BY id ASC";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        // Print table
        echo "<table class='table table-hover table-sm'>";
            echo "<thead class='thead-light'>";
                echo "<tr class='d-flex'>";
                    echo "<th class='col-1'>#</th>";
                    echo "<th class='col-xs-6 col-sm-4 col-md-3 col-lg-3'>Titulo</th>";
                    echo "<th class='d-none d-sm-block col-sm-4 col-md-5 col-lg-5'>Descrição</th>";
                    echo "<th class='col-xs-5 col-sm-3 col-md-3 col-lg-3 text-right' scope='col' class='text-right'><span class='mr-2'>Ação</span></th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            while($row = mysqli_fetch_array($result)){
                echo "<tr class='d-flex'>";
                    echo "<td class='col-1'>" . $row['id'] . "</td>";
                    echo "<td class='col-xs-6 col-sm-4 col-md-3 col-lg-3'>" . $row['titulo'] . "</td>";
                    echo "<td class='d-none d-sm-block col-sm-4 col-md-5 col-lg-5 text-truncate'>" . $row['descricao'] . "</td>";

                    // Insert parameters for update function into a variable
                    $parameters = $row['id'].",\"".$row['titulo']."\",\"".$row['descricao']."\",\"".$row['hora_abertura']."\",\"".$row['hora_fechamento']."\",\"".$row['lat']."\",\"".$row['lng']."\"";

                    echo "<td class='col-xs-5 col-sm-3 col-md-3 col-lg-4 text-left'>
                            <button class='btn btn-link btn-sm' data-toggle='collapse' data-target='#infoRow".$row['id']."' aria-expanded='false' aria-controls='infoRow".$row['id']."'>
                                <i class='fas fa-info-circle'></i>
                            </button> | 
                            <button class='btn btn-link btn-sm' onclick='openEditForm(".$parameters.")'>
                                <i class='far fa-edit'></i>
                            </button> | 
                            <button class='btn btn-link btn-sm' data-toggle='collapse' data-target='#deletePromptRow".$row['id']."' aria-expanded='false' aria-controls='deletePromptRow".$row['id']."'>
                                <i class='far fa-trash-alt'></i>
                            </button>
                        </td>";
                echo "</tr>";
                // Place data display row
                echo "<tr class='table-info collapse' id='infoRow".$row['id']."'>";
                echo "<td colspan='4'>
                        <div class='row'>
                            <div class='col-10'>
                                <div class='col-12'><i class='far fa-clock mr-2' title='Open hours'></i><span>".$row['hora_abertura']." - ".$row['hora_fechamento']."</span></div>
                                <div class='col-12'><i class='fas fa-map-marker-alt mr-2' title='coordinates'></i><span>".$row['lat']." , ".$row['lng']."</span></div>
                                <div class='col-12 d-block d-sm-none'><i class='fas fa-book mr-2'></i><span>".$row['descricao']."</span></div>
                            </div>
                            <div class='col-2'>
                                <button class='btn btn-light btn-sm mr-3 float-right v-center' data-toggle='collapse' data-target='#infoRow".$row['id']."' aria-expanded='false' aria-controls='infoRow".$row['id']."'>
                                    <i class='fas fa-chevron-up'></i>
                                </button>
                            </div>
                        </div>
                      </td>";
                echo "</tr>";
                // Deletion confirmation promt row
                echo "<tr class='table-warning text-center collapse' id='deletePromptRow".$row['id']."'>";
                echo "<td colspan='4'>
                        <span>Deseja realmente excluir esse marcador : ".$row['titulo']."?</span>
                        <button class='btn btn-outline-danger btn-sm ml-2' onclick='deletePlace(".$row['id'].")'>
                            Delete
                        </button>
                        <button class='btn btn-default btn-sm ml-2' data-toggle='collapse' data-target='#deletePromptRow".$row['id']."' aria-expanded='false' aria-controls='deletePromptRow".$row['id']."'>
                            Cancel
                        </button>
                    </td>";
                echo "</tr>";
            }
            echo "</tbody>";                            
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "<div class='alert alert-warning' role='alert'>Nenhum registro foi encontrado no banco de dados!</div>";
    }
} else{
    echo "ERROR: Unable to execute $sql. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>