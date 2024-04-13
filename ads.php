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
  <!-- <link rel="stylesheet" href="styles/styles.css"> -->
  <link rel="stylesheet" href="styles/ads.css">
</head>

<body>
<?php
    include("crud.php");
    $db = new CRUD();
    
    if(isset($_POST['id'])) {
        $db = new CRUD();
        $db->mark_sold($_POST['id']);
        $_POST['id'] = null;
    }

    $anuncios = $db->get_all_ads();
?>
    <header>
        <h1>Panel de administración</h1>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Cerrar sesión</a>
        <a href="panel.php">Crear anuncio</a>
    </header>

    <div class="ads-container">
    <?php 
        while ($row=mysqli_fetch_object($anuncios)) {
            $id=$row->id;
            $titulo=$row->titulo;
            $enVenta=$row->en_venta;
            $link=$row->link;
    ?>
        <form class="card-product" method="post" action="ads.php">
            <div class="container-img">
                <img src="<?php echo $link;?>" alt="<?php echo $titulo;?>" />
            </div>
            <div class="content-card-product">
                <h3><?php echo $titulo;?></h3>
                <input type="number" hidden value="<?php echo $id;?>" name="id"></input>
                <input
                    type="submit"
                    class="<?php echo $enVenta ? "sale" : "sold";?>"
                    <?php echo $enVenta ? "" : "disabled";?>
                    value="<?php echo $enVenta ? "Marcar vendido" : "Vendido";?>"
                >
                </input>
                <a href="./update.php?idAd=<?php echo $id;?>" <?php echo $enVenta ? "" : "disabled";?>>Editar</a>
            </div>
        </form>
    <?php
        }
    ?> 
    </div>
</body>