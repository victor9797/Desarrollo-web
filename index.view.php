<!-- 
    Materia: Computacion en el servidor web
    Actividad: Desarrollo web avanzado
    Profesor: Octavio Aguirre Lozano
    Alumno: Victor Isaac Rodriguez Saenz
    Archivo index.view.php
 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>

<body>

    <!-- Formulario -->
    <p>
        Materia: Computacion en el servidor web <br>
        Actividad: Desarrollo web avanzado <br>
        Profesor: Octavio Aguirre Lozano <br>
        Alumno: Victor Isaac Rodriguez Saenz <br>
    </p>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="title">Titulo</label><br>
        <input type="text" name="title" id="title" placeholder="Titulo" required><br>

        <label for="body">Texto</label><br>
        <textarea name="body" id="body" placeholder="Texto" required></textarea><br>

        <label for="repeat">Repetir?</label><br>
        <input type="text" name="repeat" id="repeat" placeholder="Repetir">

        <input type="submit" value="Subir" name="submit">
    </form>

    <br>

    <form action="destroy.php" method="post">
        
        <input type="submit" value="Borrar blogs" name='submit'>
    </form>

    <!-- Section de blogs -->
    <section>

        <?php if(isset($_SESSION['blogs'])): ?>
            <?php foreach($_SESSION['blogs'] as $blog): ?>
                <div>
                    <h3><?php echo $blog['title'] ?></h3>
                    <hr>
                    <p> <?php echo $blog['body'] ?> </p>
                    <br>
                    <br>
                </div>
            <?php endforeach; ?>

        <?php else:  ?>
            <div>No hay blogs</div>
        <?php endif?>
    </section>
</body>

</html>