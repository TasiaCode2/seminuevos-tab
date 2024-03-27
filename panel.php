<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
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
        <div id="left-section">
            <h2>Información del Vehículo</h2>
            <form id="car-form">
                <label for="model">Modelo:</label>
                <input type="text" id="model" name="model" required>

                <label for="price">Precio:</label>
                <input type="text" id="price" name="price" required>

                <label for="mileage">Kilometraje:</label>
                <input type="text" id="mileage" name="mileage" required>

                <label for="Color">Color:</label>
                <input type="text" id="Color" name="Color" required>

                <label for="invoice-type">Tipo de Factura:</label>
                <select id="invoice-type" name="invoice-type" required>
                    <option value="original">Original</option>
                    <option value="Refacturado">Refacturado</option>
                </select>

                <label for="additional-info">Información Adicional:</label>
                <textarea id="additional-info" name="additional-info"></textarea>

                <button type="submit">Crear Anuncio</button>
            </form>
        </div>

        <div id="right-section">
            <h2>Subir Imágenes</h2>
            <div id="image-upload">
                <input type="file" id="image" accept="image/*" style="display: none;">
                <button type="button" onclick="document.getElementById('image').click()">Seleccionar Imagen</button>
                <button type="button" onclick="clearImage()">Eliminar Imagen</button>
                <img id="image-preview" alt="Vista previa de la imagen">
            </div>
        </div>
    </div>

    <script>
        function createAd() {
            alert("Anuncio creado con éxito");
        }

        document.getElementById('image').addEventListener('change', function (event) {
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
            document.getElementById('image').value = '';
        }
    </script>

</body>
</html>
