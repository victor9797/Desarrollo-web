<?php
/**
 * Materia: Computacion en el servidor web
 * Actividad: Desarrollo web avanzado
 * Profesor: Octavio Aguirre Lozano
 * Alumno: Victor Isaac Rodriguez Saenz
 * 
 * Archivo destroy.php
 */
    destroySession();

    /**
     * Destruir la informacion de la session
     */
    function destroySession() {
        session_start();
        $count = count($_SESSION['blogs']) - 1;

        //Todo este bloque se podria reemplazar con lo siguiente, solo es para efectos de usar el do while
        //$_SESSION['blogs'] = [];
        do {
            $_SESSION['blogs'][$count] = [];
            $count--;
        }while( $count >= 0 );

        
        session_destroy();
        header("Location: index.php");
    }
?>