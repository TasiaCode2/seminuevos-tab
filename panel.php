<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<?php
    include("crud.php");
    $anuncios = new CRUD();
    include("imageUpload.php");
    $imgUpload = new ImageUpload();

    if (isset($_POST) && !empty($_POST)) {
        $title = $anuncios->sanitize($_POST['titulo']);
        $price = $anuncios->sanitize($_POST['precio']);
        $mileage = $anuncios->sanitize($_POST['kilometraje']);
        // $cat = $anuncios->sanitize($_POST['categoria']);

        $res = $anuncios->create_ad($title, $price, $mileage, 2);

        if ($res) {
            if(isset($_FILES)){
                $url = $imgUpload->upload_images($_FILES['imagen']['tmp_name']);
                $anuncios->add_link($res, $url);
                $message = "Anuncio creado con éxito!";
                $class = "alert alert-success";
            }
            else {
                $message = "No hubo imagenes";
                $class = "alert alert-success";
            }

        } else {
            $message = "No se pudo crear el anuncio. Intente más tarde.";
            $class = "alert alert-danger";
        }
    ?>
    <div class="<?php echo $class ?>">
        <?php echo $message; ?>
    </div>
<?php
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMINISTRADOR</title>
  <link rel="stylesheet" href="styles/admin.css">
</head>

<body>
    <header>
        <h1>ADMINISTRADOR</h1>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </header>

    <div id="form-container">
        <form enctype="multipart/form-data" id="car-form" method="post">
            <div id="left-section">
                <h2>Información del Vehículo</h2>
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" required>

                    <label for="model">Modelo:</label>
                    <input type="text" id="modelo" name="modelo" required>

                    <label for="precio">Precio:</label>
                    <input type="text" id="precio" name="precio" required>

                    <label for="kilometraje">Kilometraje:</label>
                    <input type="text" id="kilometraje" name="kilometraje" required>

                    <!-- <label for="invoice-type">Tipo de Factura:</label>
                    <select id="invoice-type" name="invoice-type" required>
                        <option value="original">Original</option>
                        <option value="Refacturado">Refacturado</option>
                    </select> -->

                    <!-- <label for="additional-info">Información Adicional:</label>
                    <textarea id="additional-info" name="additional-info"></textarea> -->

            </div>

            <div id="right-section">
                <h2>Subir Imágenes</h2>
                <div id="image-upload">
                    <input type="file" id="imagen" name="imagen" accept="image/*" style="display: none;">
                    <button type="button" onclick="document.getElementById('imagen').click()">Seleccionar Imagen</button>
                    <button type="button" onclick="clearImage()">Eliminar Imagen</button>
                    <img id="image-preview" alt="Vista previa de la imagen">
                </div>
            </div>

            <button type="submit">Crear Anuncio</button>
        </form>
    </div>

    <script>
        function createAd() {
            alert("Anuncio creado con éxito");
        }

        document.getElementById('imagen').addEventListener('change', function (event) {
            const preview = document.getElementById('image-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        function clearImage() {
            const preview = document.getElementById('image-preview');
            preview.src = '';
            document.getElementById('imagen').value = '';
        }
    </script>

</body>
</html>
