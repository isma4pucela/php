<html>
    <body>
        <form method="post" action="ej2.php">
            <fieldset>
                <legend>
                    Nombre <input type="text" name="nombre"/><br>
                    Apellidos <input type="text" name="apellido"/><br>
            
                    Dirección<br><select>
                        <option value="valladolid">Valladolid</option>
                        <option value="madrid">Madrid</option>
                        <option value="barcelona">Barcelona</option>
                        <option value="sevilla">Sevilla</option>
                    </select>
            
                    Sexo<br>
                        <input type="radio" name="sexo" value="hombre"/>Hombre
                        <input type="radio" name="sexo" value="mujer"/>Mujer
                        <input type="radio" name="sexo" value="ninguno" checked="checked"/>Prefiero no decirlo        

                    Títulos académicos<br>
                        <input type="checkbox" name="titulos" value="eso"/>ESO
                        <input type="checkbox" name="titulos" value="bachillerato"/>Bachillerato
                        <input type="checkbox" name="titulos" value="grmedio"/>Grado Medio

                    <input type="submit" name="enviar" value="enviar"/>Enviar
                    <input type="reset" name="borrar" value="borrar"/>Borrar
                </legend>
            </fieldset>
        </form>
    </body>
</html>

<?php
    if (isset ($_REQUEST[enviar])) {
        echo "Sus datos son: <br>";
        echo "Nombre: " $_REQUEST["nombre"]". <br>";
        echo "Apellidos: " $_REQUEST["apellidos"]". <br>";
        echo "Dirección: " $_REQUEST["direccion"]". <br>";
        echo "Sexo: " $_REQUEST["sexo"]". <br>";
        echo "Títulos académicos" $_REQUEST["titulos"]". <br>";
    }
?>