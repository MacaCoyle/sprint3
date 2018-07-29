<?php

    require_once("DB.php");
    require_once("Usuario.php");

    class DBMySQL extends DB
    {
        protected $conexion;

        public function __construct()
        {
            $dsn = 'mysql:host=localhost;dbname=migracion_dh;
            charset=utf8mb4;port=3306';
            $username ="root";
            $password = "";

            try {
                $this->conexion = new PDO($dsn, $username, $password);
            } 

            catch(Exception $e)
            {
                echo "La conexion a la base de datos falló: " . $e->getMessage();
            }
            
        }
        function guardarUsuario(Usuario $usuario)

        {
            $query = $this->conexion->prepare("INSERT INTO usuarios VALUES(default, :email, :password)");

            $query->bindValue(":email", $usuario->getEmail());
            $query->bindValue(":password", $usuario->getPassword());
            $query->execute();

            $usuario->setId($id);

            return $usuario;
        }

        function buscamePorEmail($email)
        {
            $query = $this->conexion->prepare("Select * from usuarios where email = :email");
            $query->bindValue(":email", $email);
            $query->execute();

            $usuarioFormatoArray = $query->fetch(PDO::FETCH_ASSOC);

            if ($usuarioFormatoArray) {
                $usuario = new Usuario($usuarioFormatoArray["email"], $usuarioFormatoArray["password"], $usuarioFormatoArray["id"]);
                return $usuario;
            } else {
                return null;
            }
	    }
        
        function traeTodaLaBase()
        {
            $query = $this->conexion->prepare("SELECT * FROM usuarios");
            $query->execute();
            
            $usuariosFormatoArray = $query->fetchAll(PDO::FETCH_ASSOC);
            $usuariosFormatoClase = [];
            foreach ($usuariosFormatoArray as $usuario):
                $usuariosFormatoClase[] = new Usuario($usuario["email"], $usuario["password"], $usuario["id"]);
            endforeach;

            return $usuariosFormatoClase;
        
        }
    }