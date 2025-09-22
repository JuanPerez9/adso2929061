<?php
    include '../config/app.php';
    include '../config/database.php';
    include '../config/security.php';

    // VERIFICA QUE EL ID SE RECIBA (POR GET)
    if ($_GET && isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // VALIDAR ID NUMERICO
        if (!is_numeric($id)) {
            $_SESSION['error'] = "ID de mascota inválido!";
            echo "<script> window.location.replace('dashboard.php') </script>";
            exit();
        }
        
        if(deletePet($id, $conx)) {
            $_SESSION['message'] = "La mascota fue eliminada con éxito!";
        } else {
            $_SESSION['error'] = "Error al eliminar la mascota. Puede que no exista o tenga datos relacionados.";
        }
        
        // REDIRIGIR AL DASHBOARD
        echo "<script> window.location.replace('dashboard.php') </script>";
        exit();
        
    } else {
        // REDIRIGIR CON ERROR
        $_SESSION['error'] = "No se especificó ninguna mascota para eliminar!";
        echo "<script> window.location.replace('dashboard.php') </script>";
        exit();
    }
?>