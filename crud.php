<?php
    require('./vendor/autoload.php');

	class CRUD{
		private $con;

		function __construct(){
            $dotenv = Dotenv\Dotenv::createImmutable('./');
            $dotenv->load();
			$this->connect_db();
		}

		public function connect_db(){
			$this->con = mysqli_connect($_ENV['DATABASE_HOST'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASS'], $_ENV['DATABASE_NAME']);
			if(mysqli_connect_error()){
				die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
			}
        }

        public function get_latests_ads(){ 
            $sql = "SELECT id, titulo, precio FROM anuncio LIMIT 6"; 
            $res = mysqli_query($this->con, $sql); 
            return $res; 
        } 

        public function sanitize($var){ 
            $res = mysqli_real_escape_string($this->con, $var); 
            return $res; 
        } 

        public function get_categories(){
            $sql = "SELECT * FROM categoria"; 
            $res = mysqli_query($this->con, $sql); 
            return $res; 
        }

        public function create_ad($title, $price, $mileage, $cat, $info){
            $sql = "INSERT INTO `anuncio` (titulo, precio, kilometraje, categoria, info) VALUES ('$title', '$price', '$mileage', '$cat', '$info')";
            
            try {
                $res = mysqli_query($this->con, $sql); 
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return false;
            }

            if($res){ 
              return mysqli_insert_id($this->con);; 
            } 
            return false; 
        }

        public function get_details($id){ 
            $sql = "SELECT * FROM anuncio where id='$id'";  
            $res = mysqli_query($this->con, $sql);  
            $rows = mysqli_fetch_object($res);  
            return $rows ;  
        } 
        
        public function update($nombre,$apellido,$direccion, $id){
            $sql = "UPDATE Estudiantes SET nombre='$nombre', apellido='$apellido', direccion='$direccion' WHERE id=$id"; 
            $res = mysqli_query($this->con, $sql); 
            
            return $res; 
        }
        
        public function mark_sold($id){ 
            $sql = "UPDATE anuncio SET en_venta = 0 WHERE id=$id"; 
            $res = mysqli_query($this->con, $sql); 

            // if($res){ 
            //     return true; 
            // }
            // return false; 
            return $res;  
        } 

        public function add_link($id, $url) {
            $sql = "INSERT INTO `link_foto` (anuncio_id, link) VALUES ($id, '$url')";
            $res = mysqli_query($this->con, $sql); 
            
            return $res; 
        }
    }
?>

