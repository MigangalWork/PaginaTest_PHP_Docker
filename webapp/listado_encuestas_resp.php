<?php

                    session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado encuestas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="lista_en_r.js"></script>
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
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Encuestas</h2>
                        <a href="welcome.php" class="btn btn-primary pull-right"><i class="fa"></i> Inicio</a>
                    </div>
                    <div id="txtHint"></div>
                    <div id = "result"></div>
                    <?php

                   
                    // Include config file
                    require_once "config/configuracion.php";
                    
                    // Attempt select query execution
                    $id_user = $_SESSION["id"];
                    $sql = "SELECT * FROM encuesta WHERE propietario != $id_user";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            
                                while($row = $result->fetch_array()){
                                   
                                    $row_val = $row["nombre"];
                                    $row_id = $row["id"];
                                    //echo '<button type="button" class="btn btn-primaryt" onclick="create_list($row)">Mostrar listas</button>';
                                    $list = "<script> create_list('$row_id', '$row_val')</script>";
                                    //$list = '<script> create_list("hola")</script>';
            
                                    echo $list;

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
                    
                    // Close connection
                    $mysqli->close();
                    ?>

                    
                    
                </div>
            </div>        
        </div>
    </div>
</body>
</html>