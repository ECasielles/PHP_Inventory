<?php

include('dao.php');

/*
Este fichero va a contener funciones que se utilizarán
en otros ficheros php.
*/
class App {

    protected $dao;

    //Habrá un objeto conexión para toda la aplicación
    function __construct(){
        $dao=new dao();
    }

	function getDao() {
		return $this->dao;
	}
    
	function head($titulo="", $h1="", $h2=null) {
		echo "
        <!DOCTYPE html>
        <html lang=\"es\">
        <head>
              <meta charset=\"utf-8\"/>
              <title>$titulo</title>
              <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/style.css\" />
        </head>
        <body>

        <!-- Cabecera -->
        <header>
            <h1>$h1</h1>
            <h2>$h2</h2>
        </header>
        ";
    }
    function nav() {
        echo "
        <!-- Navegacion -->
        <nav>
            <ul>
                <li><a href=\"index.php\">Información</a></li>
                <li><a href=\"inventory.php\">Inventario</a></li>
        ";
        if ($this->isLogged()) {
        	echo '<li><a href="logout.php">Logout</a></li>';  
        }          
        echo "
        	</ul>
        </nav>
        <div id=\"content\">
        ";
    }
	function footer() {
		echo "
		</div>
			<!-- Pie de pagina -->
			<footer>
				<p>Pagina realizada por: Jaime Gimenez Obtuso</p>
			</footer>
		</body>
        </html>
        ";
	}
    /**
    * Función que inicia la sesión y si no, redirecciona a login
    * Salvo login y logout, que llaman a session_start, 
    * todas las páginas lo llaman
    */
    function start_session() {
        session_start();
        if(!$this->isLogged())
            $this->showLogin();
    }
    /**
    * Función que comprueba si el usuario ha iniciado sesión
    */
    function isLogged(){
        if(!isset($_SESSION['user']) && !isset($_SESSION['password']))
            return false;
        return true;
    }
    /**
    * Función que inicia sesión en la página
    */
    function init_session($user) {
        //Si no está definida, la definimos
        if (!isset($_SESSION['user']))
            $_SESSION['user']=$user;
    }
    /**
    * Función que destruye la sesión en la página
    */
    function destroy_session() {
        //Destruye la variable
        if(isset($_SESSION['user']))
            unset($_SESSION['user']);
        session_destroy();
        $this->showIndex();
    }
    function showLogin(){
        header ('Location: php/login.php');
    }
    function showHome(){
        header ('Location: php/inventory.php');
    }
    function showIndex(){
        header ('Location: ../index.php');
    }
    function showErrorConnection() {
        $this->head();
        echo "
        <p>
            $this->$dao->error
        </p>
        ";
        $this->footer();
    }
}

?>
