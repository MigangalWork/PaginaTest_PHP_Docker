<?php 

session_start();
require_once "config/configuracion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado encuestas propias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="lista_en_read.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>

    
</head>
<body>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Lista de respuestas</h2>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["SCRIPT_NAME"]); ?>" method="post">
                        
                        <div id = form></div>
                        </br>
                        <div id = "sub" style = " float: right">
                        
                        <a href="listado.php" class="btn btn-secondary ml-2">Back</a>
                        </div>
 
                    </form>
                
                    <?php

                    $_SESSION["preguntas"] = [];
                    $num = 1;
                    $id_encuesta = $_SESSION["encuesta"];

                   
                    
                    
                    
                    // Attempt select query execution
                    
                    
                    $sql = "SELECT * FROM respuestas WHERE pregunta IN (SELECT id FROM preguntas where encuesta = $id_encuesta)";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            
                                while($row = $result->fetch_array()){

                                   
                                    $row_val = $row["respuesta"];
                                    $row_id = $row["id"];
                                    $_SESSION["preguntas"][$num] = $row_id; 
                                    //echo '<button type="button" class="btn btn-primaryt" onclick="create_list($row)">Mostrar listas</button>';
                                    $list = "<script> new_question('$row_val')</script>";
                                    //$list = '<script> create_list("hola")</script>';
            
                                    echo $list;

                                    $num++;

                                    //create_list($row["nombre"]);
                                }
                            
                            // Free result set
                            $result->free();
                        } else{
                            echo '<div class="alert alert-danger"><em>No se encontraron registros.</em></div>';
                        }
                    } else{
                        echo "Oops! Algo fue mal. Please try again later.";
                    }
                    
                    
                    ?>
                    
                </div>
            </div>        
        </div>
    </div>


   
</body>
</html>