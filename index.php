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
		<link rel="stylesheet" href="styles/styles.css" />
		<link rel="stylesheet" href="styles/index.css" />
</head>

<body>
<?php
    include("crud.php");
    $db = new CRUD();
    $anuncios = $db->get_latests_ads();
    $categorias = $db->get_categories();
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
                <li><a href="#">INICIO</a></li>
                <li>
                    <p id="category-list">CATEGORÍAS</p>
                    <ul id="categories" class="categories">
                    <?php 
                        while ($row=mysqli_fetch_object($categorias)) {
                        $categoria=$row->tipo;
                    ?>
                        <li class="category">
                            <a href="search.php?category=<?php echo $categoria;?>"><?php echo $categoria;?></a>
                        </li>
                    <?php
                        }
                    ?> 
                    </ul>
                </li>
            </ul>
        </section>

        <section class="main-section">
            <h1>Anuncios más nuevos</h1>

            <form class="search-form" method="get" action="search.php">
                <input type="search" placeholder="Buscar..." name="keywords"/>
                <input type="submit" class="btn-search" value="Buscar" title="Buscar" id="search-icon"/>
            </form>
        
            <!-- Los ultimos 6 anuncios -->
            <div class="ads-container">
            <?php 
                while ($row=mysqli_fetch_object($anuncios)) {
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

	<section class="blogs">
        <h2>Últimos Blogs</h2>

        <div class="container-blogs">
            <div class="card-blog">
                <div class="container-img">
                    <img src="img/Precio-Gasolina.jpg" alt="Imagen Blog 1" />
                </div>
                <div class="content-blog">
                    <h3>EL PRECIO DE LA GASOLINA</h3>
                    <span>31 DE MARZO 2024</span>
                    <p>
                        "En un mundo donde los precios de la gasolina son una preocupación constante 
                        para conductores, empresas y gobiernos, la actualidad del mercado del petróleo 
                        es más relevante que nunca, Entra para mas Información aqui.. 
                    </p>
                    <div class="btn-read-more" > <a href="https://www.nacionalgasolinero.com"target="_blank">Leer más</a></div>
                </div>
            </div>
            <div class="card-blog">
                <div class="container-img">
                    <img src="img/Repuve.jpg" alt="Imagen Blog 2" />
                </div>
                <div class="content-blog">
                    <h3>Repuve (Registro Público Vehicular)</h3>
                    <span>30 DE MARZO 2024</span>
                    <p>
                        Este es un sistema público de registro de vehículos en México. 
                        Su objetivo es mantener una base de datos de todos los vehículos 
                        en el país para ayudar a prevenir el robo de automóviles, Verifica tu auto aqui. 
                    </p>
                    <div class="btn-read-more"> <a href="https://www.gob.mx/sesnsp/acciones-y-programas/registro-publico-vehicular-repuve-168639"target="_blank">Leer más</a></div>
                </div>
            </div>
            <div class="card-blog">
                <div class="container-img">
                    <img src="img/CSA.jpg" alt="Imagen Blog 3" />
                </div>
                <div class="content-blog">
                    <h3>Centro de servicio Automotriz</h3>
                    <span>30 DE MARZO 2024</span>
                    <p>
                        Finalmente nuestro único propósito es que cada uno de nuestros clientes 
                        disfrute la mejor versión de su auto porque lo mereces.Para servicios 
                        o cualquier mantenimiento,visita aqui.
                    </p>
                    <div class="btn-read-more"><a href="https://www.talleresfelces.com" target="_blank">Leer más</a></div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container container-footer">
            <div class="menu-footer">
                <div class="contact-info">
                    <p class="title-footer">Información de Contacto</p>
                    <ul>
                        <li>
                            Carretera Periferico,Villahermosa,Tabasco
                        </li>
                        <li>Teléfono: 9932135495</li>
                        <li>Email:  LuxeCars_tab@outlook.com</li>
                    </ul>
                </div>

                <div class="newsletter">
                   <p class="title-footer">Cotiza con nosotros</p>
                    <div class="content">
                        <p>¡Para una cotización rápida y eficaz!</p>
                        <input type="email" id="emailInput" placeholder="Ingresa tu correo aquí...">
                        <button type="submit" onclick="enviarCorreo()" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Enviar</button>
                        <p id="mensajeCorreoEnviado" style="display: none; color: green;">Correo enviado</p>
                        <p id="mensajeError" style="display: none; color: red;">Ingresa un correo válido</p>
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
    <script type="text/javascript" src="./scripts/index.js"></script>
    <script type="text/javascript" src="./scripts/menu.js"></script> 

    <script>
        function enviarCorreo() {
            var correo = document.getElementById("emailInput").value;
            
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (regex.test(correo)) {
            
            
                document.getElementById("emailInput").value = "";

                document.getElementById("mensajeCorreoEnviado").style.display = "block";

                setTimeout(function() {
                    document.getElementById("mensajeCorreoEnviado").style.display = "none";
                }, 2000);
                
                document.getElementById("mensajeError").style.display = "none";
            } else {

                document.getElementById("mensajeError").style.display = "block";

                // Ocultar el mensaje de error después de 2 segundos
                setTimeout(function() {
                    document.getElementById("mensajeError").style.display = "none";
                }, 2000);
            }
        }
    </script>
</body>
</html>
