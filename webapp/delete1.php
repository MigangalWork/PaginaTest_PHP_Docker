

<?php

    // Include config file
    require_once "config/configuracion.php";

    
    // Prepare a delete statement
    $sql = "DELETE FROM encuesta WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $id1 = (int)$_GET["q"];
        $param_id = $id1;
        
        // Attempt to execute the prepared statement
        $stmt->execute();

    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
    echo 'Hecho';

?>