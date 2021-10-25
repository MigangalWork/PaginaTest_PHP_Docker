<?php

session_start();

$_COOKIE["preguntas_hechas"] = $_COOKIE["preguntas_hechas"] + intvar($_GET["q"]);




?>