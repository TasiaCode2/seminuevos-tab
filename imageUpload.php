<?php
    require_once "vendor/autoload.php";

    use Cloudinary\Configuration\Configuration;
    use Cloudinary\Api\Upload\UploadApi;

    $dotenv = Dotenv\Dotenv::createImmutable('./');
    $dotenv->load();

    class ImageUpload {
        private $cloudinary;

        function __construct(){
			$this->cloudinary = Configuration::instance();
            $this->cloudinary->cloud->cloudName = $_ENV['CLOUD_NAME'];
            $this->cloudinary->cloud->apiKey = $_ENV['API_KEY'];
            $this->cloudinary->cloud->apiSecret = $_ENV['API_SECRET'];
            $this->cloudinary->url->secure = true;
		}

        public function upload_images($file) {
            $conn = new UploadApi();
            
            $result = $conn->upload($file, ["media_metadata" => true]);

            return $result->offsetGet("secure_url");
        }
    }
?>