<?php
    session_start();

    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.html');
        exit;
    }
?>

<?php
    include("crud.php");
    $db = new CRUD();
    $anuncio = null;

    // Si es un GET y hay un ID, busca los detalles en la db
    if(isset($_GET) && isset($_GET['idAd'])) {
        $idAd = $db->sanitize($_GET['idAd']);
        $anuncio = $db->get_ad_by_id($idAd);
    } else if (!isset($_POST)) {
        // si no es un GET o falta un ID, y tampoco es un PUT, redirecciona
        header('Location: panel.php');
    }

    include("imageUpload.php");
    $imgUpload = new ImageUpload();

    // Si es un PUT, guarda los nuevos datos en la db
    if (isset($_POST) && !empty($_POST)) {
        $title = $db->sanitize($_POST['titulo']);
        $model = $db->sanitize($_POST['modelo']);
        $price = $db->sanitize($_POST['precio']);
        $mileage = $db->sanitize($_POST['kilometraje']);
        $category = $db->sanitize($_POST['categoria']);
        $info = $db->sanitize($_POST['info']);
        
        $res = $db->update_ad($_GET['idAd'], $title, $model, $price, $mileage, $category, $info);
        
        if ($res) {
            if(isset($_POST['image-changed']) && $_POST['image-changed']){
                echo "hay algo en files";
                $url = $imgUpload->upload_images($_FILES['imagen']['tmp_name']);
                $db->add_link($res, $url);
            }
            echo "
            <script type='text/javascript'>
                alert('Anuncio actualizado con éxito!');
                window.location.href='ads.php';
            </script>";
        } else {
            echo "
            <script type='text/javascript'>
                alert('No se pudo actualizar el anuncio. Intente más tarde.';
                window.location.href='ads.php';
            </script>";
        }
    ?>
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
<?php
    $db = new CRUD();
    $categorias = $db->get_categories();
?>
    <header>
        <h1>Panel de administración</h1>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Cerrar sesión</a>
        <a href="ads.php">Administrar anuncios</a>
    </header>

    <div id="form-container">
        <form enctype="multipart/form-data" id="car-form" method="post">
            <input type="checkbox" name="image-changed" id="image-changed" hidden>
            <div id="left-section">
                <h2>Información del Vehículo</h2>
                
                <?php 
                    $row=null;
                    $titulo=null;
                    $modelo=null;
                    $precio=null;
                    $kilometraje=null;
                    $categoria=null;
                    $info=null;
                    $link=null;
                    
                    if ($anuncio != null) {
                        $row=mysqli_fetch_object($anuncio);
                        $titulo=$row->titulo;
                        $modelo=$row->modelo;
                        $precio=$row->precio;
                        $kilometraje=$row->kilometraje;
                        $categoria=$row->categoria;
                        $info=$row->info;
                        $link=$row->link;
                    }
                ?>

                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" required value="<?php echo ($titulo != null) ? "$titulo" : ""; ?>">

                    <label for="titulo">Categoría:</label>
                    <select type="text" id="categoria" name="categoria" required>
                    <?php 
						while ($row=mysqli_fetch_object($categorias)) {
                            $idCat=$row->id;
                            $cat=$row->tipo;
					?>
                        <option
                            value="<?php echo $idCat;?>"
                            <?php echo ($categoria != null && $categoria == $idCat) ? "checked" : "";?>
                        >
                            <?php echo $cat;?>
                        </option>
					<?php
                        }
                    ?> 
                    </select>

                    <label for="model">Modelo:</label>
                    <input type="text" id="modelo" name="modelo" required value="<?php echo ($modelo != null) ? "$modelo" : ""; ?>">

                    <label for="precio">Precio:</label>
                    <input type="text" id="precio" name="precio" required value="<?php echo ($precio != null) ? "$precio" : ""; ?>">

                    <label for="kilometraje">Kilometraje:</label>
                    <input type="text" id="kilometraje" name="kilometraje" required value="<?php echo ($kilometraje != null) ? "$kilometraje" : ""; ?>">

                    <label for="additional-info">Información Adicional:</label>
                    <textarea id="additional-info" name="info">
                        <?php echo ($info != null) ? "$info" : ""; ?>
                    </textarea>
            </div>

            <div id="right-section">
                <h2>Subir Imágenes</h2>
                <div id="image-upload">
                    <input type="file" id="imagen" name="imagen" accept="image/*" style="display: none;">
                    <button type="button" onclick="document.getElementById('imagen').click()">Seleccionar Imagen</button>
                    <button type="button" onclick="clearImage()">Eliminar Imagen</button>
                    <img id="image-preview" alt="Vista previa de la imagen" src="<?php echo ($link != null) ? "$link" : "" ?>">
                </div>
            </div>

            <button type="submit">Actualizar anuncio</button>
        </form>
    </div>

    <script>
        function createAd() {
            alert("Anuncio creado con éxito");
        }

        const imageChanged = document.getElementById('image-changed');

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

            imageChanged.checked = true;
        });

        function clearImage() {
            const preview = document.getElementById('image-preview');
            preview.src = '';
            document.getElementById('imagen').value = '';
        }
    </script>

</body>
</html>
