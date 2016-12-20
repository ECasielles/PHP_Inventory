<?php
    //Aquí se pone la cadena de conexión
    //esta cadena es estándar
    define("MYSQL_HOST", "mysql:$db;host=127.0.0.1");  
    define("MYSQL_USER", www-data);
    define("MYSQL_PASSWORD", www-data);
    define("DATABASE", "inventory");

    /* Se define a continuación el nombre de todas las tablas */
    define ("TABLE_USER", user);

    /* Se define a continuacion las columnas de las tablas */
    define ("USER_NAME", username);
    define ("USER_PASSWORD", password);


    class dao {
        protected $conn;
        public $error; // Lo suyo sería tener una clase Error

        /* Se crea un objeto de conexión a la base de datos en el constructor */
        function __construct() {
            // Hacemos la conexión, para lo cual miramos la documentación PDO
            try {
                $conn=new PDO(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
            } catch (PDOException $e) {
                $this->error="Error en la conexión: ".$e->getMessage();
                $this->conn=null;
            }
        }
        function __destruct() {
            if ($this->isConnected())
                $this->conn=null;
        }
        function isConnected() {
            return ($this->conn==null?false:true);
        }               
        function getConnect() {
            return $this->connect;
        }
    }

?>