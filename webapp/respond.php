<?php

                    

                    require_once "config/configuracion.php";

                    session_start(); 
                    

                    


                    $id_encuesta = intval($_SESSION["encuesta"]);

                    
                    
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                    
                        $propietario = $_SESSION["id"];
                        
                        
                    
                        
                    
                            for ($i = $_SESSION["num_questions"]; $i > 0; $i-- ){
                                
                                

                                $id = $_SESSION["preguntas"][$i];
                                
                    
                                $question_num = "question" . $i;
                                $input_question = trim($_POST[$question_num]);

                                    $sql = "INSERT INTO respuestas (id, respuesta, pregunta) VALUES (?, ?, ?)";
                        
                                    if($stmt = $mysqli->prepare($sql)){
                                        // Bind variables to the prepared statement as parameters
                                        $stmt->bind_param("isi", $param_id, $param_question, $param_encuesta);
                                        
                                        // Set parameters
                                        $param_id = random_int(0, 1000000);
                                        $param_encuesta = $id;
                                        $param_question = $input_question;
                                        
                                    
                                        
                                        // Attempt to execute the prepared statement
                                        if($stmt->execute()){
                                            // Records created successfully. Redirect to landing page
                                            
                                        } else{
                                            echo "Oops! Algo fue mal. Please try again later.";
                                        }
                                        $stmt->close();
                                    }
                    
                                        // Close statement
                                        
                    
                                
                            }
                    
                            
                    
                            // Close connection
                            $mysqli->close();
                    
                            header("location: listado_encuestas_resp.php");
                            exit();
                    
                            
                        }
                    
                        
                        
                        
                    
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
    <script type="text/javascript" src="lista_en_p.js"></script>
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
                    <h2 class="mt-5">Responder Encuesta</h2>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["SCRIPT_NAME"]); ?>" method="post">
                        
                        <div id = form></div>
                        </br>
                        <div id = "sub" style = " float: right">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="listado_encuestas_resp.php" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
 
                    </form>
                
                    <?php

                    $_SESSION["preguntas"] = array();
                    $num = 1;

                   
                    
                    
                    
                    // Attempt select query execution
                    
                    $_SESSION["num_questions"] = 0;
                    $sql = "SELECT * FROM preguntas WHERE encuesta = $id_encuesta";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            
                                while($row = $result->fetch_array()){

                                    $_SESSION["num_questions"] = $_SESSION["num_questions"] + 1;
                                    
                                   
                                    $row_val = $row["pregunta"];
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