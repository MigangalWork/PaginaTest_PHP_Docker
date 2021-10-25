<?php
// Include config file

require_once "config/configuracion.php";

//Start session

session_start();

setcookie("preguntas_hechas", 0, [
    'expires' => time() + 3600,
    'path' => '/',
    'domain' => 'localhost',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Lax',
]);
 
// Define variables and initialize with empty values
$question = $propietario = $restricciones = $nombre = "";
$fecha_inicio =  $fecha_final = "";
$num_questions = 1;
//$_SESSION["num_questions"] = 1;
$_SESSION["encuesta"] = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


    $num_questions = $_SESSION["num_questions"];
    
    
    // Validate nombre
    
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Please enter a name.";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Please enter a valid name.";
    } else{
        $nombre = $input_nombre;
    }
/*
     Validate nombre_largo
    $input_nombrelargo = trim($_POST["nombrelargo"]);
    if(empty($input_nombre)){
        $nombrelargo_err = "Please enter a name.";
    } elseif(!filter_var($input_nombrelargo, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombrelargo_err = "Please enter a valid name.";
    } else{
        $nombrelargo = $input_nombrelargo;
    }*/
    
    // Validate fabricante
    
    $input_restricciones = trim($_POST["restricciones"]);
    if(empty($input_restricciones)){
        $restricciones_err = "Please enter a restriction";
    } else{
        
        $restricciones = $input_restricciones;
    }

    $input_fecha_inicio = trim($_POST["fecha_inicio"]);
    if(empty($input_fecha_inicio)){
        $fecha_inicio_err = "Please enter a fecha inicio";
    } else{
        $fecha_inicio = $input_fecha_inicio;
    }

    $input_fecha_final = trim($_POST["fecha_final"]);
    if(empty($input_fecha_final)){
        $fecha_final_err = "Please enter a fecha final";
    } else{
        $fecha_final = $input_fecha_final;
    }

    //$input_prop = trim($_POST["prop"]);

    $propietario = $_SESSION["id"];
    $id = random_int(0, 1000000);
    $_SESSION["encuesta"] = $id;

    
    // Check input errors before inserting in database
    if(empty($restricciones_err) && empty($nombre_err) && empty($question_err) && empty($fecha_inicio_err) && empty($fecha_final_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO ENCUESTA (id, nombre, restricciones, fecha_inicio, fecha_final, propietario) VALUES (?, ?, ?, ?, ?, ?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("issssi", $param_id, $param_nombre, $param_restricciones, $param_fecha_inicio, $param_fecha_final, $param_propietario);
            
            // Set parameters
            $param_id = $id;

            $param_nombre = $nombre;
            $param_restricciones = $restricciones;
            $param_fecha_inicio = date("Y-m-d", strtotime($fecha_inicio));
            $param_fecha_final = date("Y-m-d", strtotime($fecha_final));
            $param_propietario = $propietario;

 

            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                
                /*
                
                 Records created successfully. Redirect to landing page*/
                
            } else{
                echo "Oops! Algo fue mal. Please try again later.";
            }
        
         
        // Close statement
        $stmt->close();
        }

        for ($i = $num_questions; $i > 0; $i-- ){

            $question_num = "question" . $i;
            $input_question = trim($_POST[$question_num]);
            if(empty($input_question)){
                $question_err = "Please enter a question";
            } else{
                $question = $input_question;
            }
            
            if(empty($question_err)){
            
                $sql = "INSERT INTO PREGUNTAS (id, pregunta, encuesta) VALUES (?, ?, ?)";
    
                if($stmt = $mysqli->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bind_param("isi", $param_id, $param_question, $param_encuesta);
                    
                    // Set parameters
                    $param_id = random_int(0, 1000000);
                    $param_encuesta = $id;
                    $param_question = $question;
                }
                    
                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        // Records created successfully. Redirect to landing page
                        
                    } else{
                        echo "Oops! Algo fue mal. Please try again later.";
                    }

                    // Close statement
                    $stmt->close();

            }
        }

        

        // Close connection
        $mysqli->close();

        header("location: listado.php");
        exit();

        
    }

    
    
    
}
?>
 
 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Crear Votacion</h2>
                    <p>Crea una votacion</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["SCRIPT_NAME"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="">
                            <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Restricciones</label>
                            <input type="text" name="restricciones" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="">
                            <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>fecha inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="">
                            <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>fecha fin</label>
                            <input type="date" name="fecha_final" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="">
                            <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                        </div>
                    
                        <div class="form-group">
                            <label>Pregunta numero 1</label>
                            <input type="text" name="question1" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="">
                            <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                        </div>
                        <div id = form></div>
                        </br>
                        <div id = "sub" style = " float: right">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="listado.php" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
 
                    </form>
                    </br>
                    <div>
                        <input type = "button" class="btn btn-secondary" value= "Add question" onclick = "new_question()">
                    </div>
                    
                </div>
            </div>        
        </div>
    </div>
<script src="create.js"></script>
</body>
</html>