<?php
    include_once('app.php');
    global $app;
    $app=new App();
    $app->head("Inicio de sesión", "Login");
    $app->nav();
?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <table id="tlogin">
        <tr>
            <td>Usuario:
                <input type="text" name="user" value="">
            </td>
        </tr>
        <tr>
            <td>Contraseña:        
                <input type="password" name="password" value="">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="submit" value="Enviar">
            </td>
        </tr>
    </table>
</form>

<?php
    if ($_SERVER['REQUEST_METHOD']=="POST"){
        $user = $_POST['user'];
        $password = $_POST['password'];
        
        if(empty($user)) {
            echo "Debe introducir un nombre";
            //Innecesario desde HTML5
        } else if (empty($password)) {
            echo "Debe introducir una contraseña";
        } else {
            //Conectar a la base de datos y comprobar si el usuario existe

            // 1.Crear conexión 
            if (is_null($app->getDao()->isConnected())) {
                $this->showErrorConnection();
            } else {
            
            }   

            //Guardar sesión
            $app->init_session($user);
            
            //Redireccionar a otra página
            //PHP es servidor y no de cliente
            //por lo que si queremos que haga cosas de 
            //forma automática usaremos javascript
            //Y recordar siempre escapar las comillas en estos casos
            echo "
                <script language=\"javascript\">
                    window.location.href=\"inventory.php\";
                </script>
                ";
        }
    }

    $app->footer();
?>