<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
		<title>SEMINUEVOS TABASCO</title>
		<link rel="stylesheet" href="./styles/styles.css" />
		<link rel="stylesheet" href="./styles/search.css" />
</head>

<body>
<?php
    include("crud.php");
    $db = new CRUD();
    $categorias = $db->get_categories();
    $results = [];

    if (isset($_GET) && !empty($_GET)) {
        $keywords = $db->sanitize($_GET['keywords']);
        // $filters = ['category' => $db->sanitize($_GET['category'])];

        $results = $db->search($keywords);
    }
?>
    <header>
        <box-icon name='menu' id="menu-icon" class="menu-icon"></box-icon>
        
        <div class="logo-container">
            <a href="./index.php"><img class="logo" src="./img/Logo.jpg" alt=""></a>
        </div>
    </header>

    <main class="main-content">
        <section id="menu-container" class="side-section">
            <box-icon name='x' id="close-icon" class="close-icon"></box-icon>
            <ul id="menu" class="menu">
                    <li><a href="./index.php">INICIO</a></li>
                    <li>
                        <p>FILTROS</p>
                        <form method="get" action="search.php">
                            <div class="search-form">
                                <input type="search" placeholder="Palabras clave..." name="keywords" value="<?php echo $_GET["keywords"]; ?>"/>
                            </div>
                            
                            <div class="categories-filter">
                                <p>Categorías</p>
                                <?php 
                                    while ($row=mysqli_fetch_object($categorias)) {
                                        $categoria = $row->tipo;
                                        $id = $row->id;
                                        ?>
                                        <div>
                                            <input type="radio" id="<?php echo $categoria;?>" name="category" value="<?php echo $id;?>">
                                            <label for="<?php echo $categoria;?>" class="form-category"><?php echo $categoria;?></label><br>
                                        </div>
                                <?php
                                    }
                                ?>
                            </div>
                            
                            <div>
                                <p>Año</p>
                                <input type="number" id="min-year" name="minYear" min="1992" max="2022" value="1992">
                                <input type="number" id="max-year" name="maxYear" min="1992" max="2022" value="2022">
                            </div>

                            <div>
                                <p>Kilometraje</p>
                                <input type="range" min="10000" max="400000" step="50000"/>
                            </div>

                            <input type="submit" class="btn-search" value="Buscar" title="Buscar" id="search-icon"></input>
                        </form>
                    </li>
                </ul>
        </section>

        <section class="main-section">
            <h1>Resultados de búsqueda</h1>
            
            <div class="ads-container">
                <?php 
                    while ($row=mysqli_fetch_object($results)) {
                        $titulo=$row->titulo;
                        $precio=$row->precio;
                        $info=$row->info;
                        $link=$row->link;
                ?>
                    <div class="card-product">
                        <div class="container-img">
                            <img src="<?php echo $link;?>" alt="mustang" />
                        </div>
                        <div class="content-card-product">
                            <h3><?php echo $titulo;?></h3>
                            <p class="price">$<?php echo $precio;?></p>
                        </div>
                        <div class="product-info">
                            <p><?php echo $info;?></p>
                        </div>
                    </div>
                <?php
                    }
                ?> 
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container container-footer">
            <div class="menu-footer">
                <div class="contact-info">
                    <p class="title-footer">Información de Contacto</p>
                    <ul>
                        <li>
                            Carretera Periferico,Villahermosa,Tabasco
                        </li>
                        <li>Teléfono: 9999999999</li>
                        <li>Email:  seminuevos_tab@outlook.com</li>
                    </ul>
                </div>

                <div class="newsletter">
                    <p class="title-footer">Cotiza con nosotros </p>

                    <div class="content">
                        <p>
                            ¡Para una cotizacion rapida y eficaz!
                        </p>
                        <input type="email" placeholder="Ingresa tu correo aquí...">
                        <button>Enviar</button>
                    </div>
                </div>
            </div>

            <div class="copyright">
                <p>
                    Desarrollado Por
                </p>

                <div class="social-icons">
                    <span class="facebook">
                        <a href="https://www.facebook.com/tu_pagina_de_facebook" target="_blank">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </span>
                    <span class="X">
                        <a href="https://www.twitter.com/tu_cuenta_de_twitter" target="_blank">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                    </span>
                    <span class="instagram">
                        <a href="https://www.instagram.com/tu_cuenta_de_instagram" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </span>
                    <span class="TikTok">
                        <a href="https://www.tiktok.com/@tu_cuenta_de_tiktok" target="_blank">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/73d63dce2b.js" 
    crossorigin="anonymous"></script>  
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script type="text/javascript" src="./menu.js"></script> 
</body>
</html>