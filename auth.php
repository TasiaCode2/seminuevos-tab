<?php
require('./vendor/autoload.php');

// Crear la carpeta para guardar sesiones si no existe
$dir = dirname( dirname(__FILE__) ) . '/tmp';
if (!is_dir($dir)) {
    mkdir($dir, 0775, true);
}

session_save_path($dir);
session_start();

$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

$DATABASE_HOST = $_ENV['DATABASE_HOST'];
$DATABASE_USER = $_ENV['DATABASE_USER'];
$DATABASE_PASS = $_ENV['DATABASE_PASS'];
$DATABASE_NAME = $_ENV['DATABASE_NAME'];

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if ( mysqli_connect_errno() ) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ( !isset($_POST['username'], $_POST['password']) ) {
	exit('Requiere no dejar espacios en blanco');
}

if ($stmt = $con->prepare('SELECT id, contra FROM login WHERE usuario = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
       
        if ($_POST['password'] === $password) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: panel.php');
        } else {
            echo 'Username o password incorrecto';
        }
    } else {
        echo 'Username o password incorrecto';
    }

	$stmt->close();
}
?>