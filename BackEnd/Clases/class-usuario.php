<?php 
    
    class Usuario{
        private $nombre;
        private $apellido;
        private $identidad;
        private $tiempo;
        private $estado;

        public function __construct($nombre, $apellido, $identidad, $tiempo, $estado){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->identidad = $identidad;
            $this->tiempo = $tiempo;
            $this->estado = $estado; 
        }

        public function asignarNombre($nombre){
            $this->nombre = $nombre;
        }

        public function asignarapellido($apellido){
            $this->apellido = $apellido;
        }

        public function obtenerNombre(){
            return $this->nombre;
        }

        public function obtenerApellido(){
            return $this->apellido;
        }

        public function getIdentidad($identidad){
            $this->getIdentidad = $identidad;
        }

        public function setIdentidad(){
            return $this->identidad;
        }

        public function getTiempo($tiempo){
            $this->tiempo = $tiempo;
        }

        public function setTiempo(){
            return $this->tiempo;
        }

        public function getEstado($estado){
            $this->estado = $estado;
        }

        public function setEstado(){
            return $this->estado;
        }

        //Aqui hacer la obtencion del de las operacion

        public function guardarUsuario(){
            $servername = "127.0.0.1";
            $username = "root";
            $password = "01001101Moy*r2-d2";
            $dbname = "banco";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO `clientes`(`nombre_user`,`apellido_user`,`id_user`,`user_time_add`,`user_status`)VALUES(?,?,?,?,?);";
            $statement = $conn->prepare($sql);
            $statement->bind_param("sssss", $nombre, $apellido, $identidad, $tiempo, $estado);
            $statement->execute();
            if($statement){
                  echo "Se Guardo";
            }else{
                echo "No se guardo";
            }
        }

        public static function obtenerUsuario($id){
            $servername = "127.0.0.1";
            $username = "root";
            $password = "01001101Moy*r2-d2";
            $dbname = "banco";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * from clientes where user_cod = ?";
            $statement = $conn->prapere($sql);
            $statement->bind_param("s", $id);
            $statement->execute();
            if($statement->num_rows > 0){
                 while($row = $statement->fetch_assoc()) {
                    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
              }
                $result = json_encode($statement);
                echo $result;
            }
        }

        public function eliminarUsuario(){

        }
            
    }
?>
