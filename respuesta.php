
<?php
 (defined('STARTAPP')) OR exit('No direct script access allowed');
?>
<html>
        <head></head>
        <body>
            <h1>Persona</h1>
            <form method='post'>
                <label for='nombre'>Digite su nombre:</label>                
                <input type='text' name='nombre'  value=''>
                <Br>

                <label for='hijos'>Cuántos hijos tiene:</label>
                <input type='number' name='hijos' value=''>
                <Br>

                <label for='fechaNacimiento'>Digite el año de nacimiento:</label>
                <input type='number' name='fechaNacimiento' value=''>
                <Br>

                <br>
                <input type='submit' value='Crear Persona'>
            </form>
            <br><br>

<?php if($persona->isIniciada()){

    print  "Persona creada:
            <p>Nombre: " . $persona->getNombre() . "</p>
            <p>Edad: " . $persona->getEdad() . "</p>
                ";

    $hijos = isset($_POST['hijos']) ? (int)$_POST['hijos'] : 0; 
    for($a = 0; $a < $hijos; $a++){
        print "<p>Hijo: " . ($a + 1) . "</p>";        
    }
    
}

?>

</body></html>