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
            $sql = "SELECT a.id, a.titulo, a.precio, a.info, lf.link FROM anuncio a JOIN link_foto lf ON a.id = lf.anuncio_id WHERE a.en_venta = 1 ORDER BY a.id DESC LIMIT 6; "; 
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

        public function create_ad($title, $model, $price, $mileage, $cat, $info){
            $sql = "INSERT INTO `anuncio` (titulo, modelo, precio, kilometraje, categoria, info)
            VALUES ('$title', '$model', '$price', '$mileage', '$cat', '$info')";
            
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

        public function get_all_ads(){ 
            $sql = "SELECT a.id, a.titulo, a.en_venta, lf.link FROM anuncio a JOIN link_foto lf ON a.id = lf.anuncio_id";  
            $res = mysqli_query($this->con, $sql);  
            return $res ;  
        } 
        
        public function mark_sold($id){ 
            $sql = "UPDATE anuncio SET en_venta = 0 WHERE id=$id"; 
            $res = mysqli_query($this->con, $sql); 

            return $res;  
        } 

        public function add_link($id, $url) {
            $sql = "INSERT INTO `link_foto` (anuncio_id, link) VALUES ($id, '$url')";
            $res = mysqli_query($this->con, $sql); 
            
            return $res; 
        }

        public function search($keywords, $filters) {
            $keywords = implode("%", explode(" ", $keywords));

            $sql = "SELECT a.id, a.titulo, a.precio, a.info, lf.link 
            FROM anuncio a JOIN link_foto lf ON a.id = lf.anuncio_id 
            WHERE titulo LIKE '%$keywords%'"; 

            if(sizeof($filters) > 0) {
                $minPrice = $filters['minPrice'];
                $maxPrice = $filters['maxPrice'];
            
                if ($filters['category'] > 0) { // categoria 0 = todas las categorias
                    $category = $filters['category'];
                    $sql = $sql . " AND categoria = $category";
                }

                $sql = $sql . " AND precio BETWEEN $minPrice AND $maxPrice";
            }

            $res = mysqli_query($this->con, $sql);
            return $res;
        }

        public function get_ad_by_id($id) {
            $sql = "SELECT a.id, a.titulo, a.modelo, a.precio, a.kilometraje, a.info, a.categoria, lf.link
            FROM anuncio a JOIN link_foto lf ON a.id = lf.anuncio_id
            WHERE a.id = $id";  
            $res = mysqli_query($this->con, $sql);
            return $res ;
        }

        public function update_ad($id, $title, $model, $price, $mileage, $category, $info) {
            $sql = "UPDATE anuncio
            SET titulo = '$title', modelo = $model, precio = $price,
            kilometraje = $mileage, categoria = $category, info = '$info'
            WHERE id = $id"; 

            $res = mysqli_query($this->con, $sql); 

            return $res;  
        }
    }
?>

