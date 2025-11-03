<html>
    <body>
        <form method="post" action="examen.php">
            <fieldset>
                <legend>
                    <p>Usuario <input type="text" name="usuario"/><br></p>
                    <p>Contraseña <input type="password" name="contraseña"/><br></p>

                    <p>Nacionalidad<br><select name="nacionalidad">
                        <option value="españa">España</option>
                        <option value="francia">Francia</option>
                        <option value="alemania">Alemania</option>
                    </select></p>

                    <p>Sexo<br>
                        <input type="radio" name="sexo" value="hombre"/>Hombre
                        <input type="radio" name="sexo" value="mujer"/>Mujer
                    </p>
                    
                    <p><input type="submit" name="enviar"/>Enviar</p>
                    <p><input type="reset" name="borrar"/>Borrar</p>
                </legend>
            </fieldset>
        </form>
    </body>
</html>

<?php
    if (isset ($_REQUEST[enviar])) {
        echo "Bienvenido" $_REQUEST["usuario"]"."
    } else {
        echo "Debe introducir todos los datos."
    }
?>