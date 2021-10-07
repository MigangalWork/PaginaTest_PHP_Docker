<?php
// Include config file
require_once "config/configuracion.php";
 
// Define variables and initialize with empty values
$nombre = $nombrelargo = $fabricante = $numdosis = "";
$tiempominimo =  $tiempomaximo = "";
$nombre_err = $nombrelargo_err = $fabricante_err = $numdosis_err ="";
$tiempominimo_err =  $tiempomaximo_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Please enter a name.";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Please enter a valid name.";
    } else{
        $nombre = $input_nombre;
    }

    /* Validate nombre_largo
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

    $input_question = trim($_POST["question"]);
    if(empty($input_restricciones)){
        $restricciones_err = "Please enter a restriction";
    } else{
        $restricciones = $input_restricciones;
    }
    
    
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($fabricante_err) && empty($nombrelargo_err)&& empty($numdosis_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO encuesta (nombre, restricciones, fecha_inicio, fecha_final, propietario) VALUES (?, ?, ?, ?, ?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_nombre, $param_restricciones);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_restricciones = $restricciones;
            $param_fecha_inicio = $fecha_inicio;
            $param_fecha_final = $fecha_final;
            $param_propietario = $propietario;
 

            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: listado.php");
                exit();
            } else{
                echo "Oops! Algo fue mal. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
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
                            <label>Pregunta numero 1</label>
                            <input type="text" name="nombre" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>">
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
                        <input class="btn btn-secondary" value= "Add question" onclick = "new_question()">
                    </div>
                    
                </div>
            </div>        
        </div>
    </div>
<script src="create.js"></script>
</body>
</html>