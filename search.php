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
		<link rel="stylesheet" href="styles.css" />
		<link rel="stylesheet" href="index.css" />
</head>

<body>
    <header>
        <div class="container-hero">
            <div class=" container hero">
                <div>Menú logo</div>

                <div class="container-logo">
                    <h1 class="logo"> <a href="/index.html">LuxeCars</a></h1>
                </div>
            </div>
        </div>
    </header>


    <main class="main-content">
        <section id="menu-container" class="side-section">
            <ul id="menu">
                <li>FILTROS</li>
            </ul>
        </section>

        <section class="container top-products">
            <!-- Sección de productos destacados -->
            <h1 class="heading-1">Búsqueda</h1>

            <!-- Opciones de la sección de productos -->
            <div class="container-options">
                <form class="search-form" method="get" action="search.php">
                    <input type="search" placeholder="Buscar..." name="keywords" value="<?php echo $_GET["keywords"]; ?>"/>
                    <input type="submit" class="btn-search" value="" title="Buscar" id="search-icon">
                        <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
                    </input>
                </form>
            </div>
        
            <div class="container-products">
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
</body>
</html>