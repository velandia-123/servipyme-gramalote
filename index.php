<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servipyme Gramalote</title>
    <link rel="icon" href="logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root{
            --flag-blue: #094cd3ff;       /* azul principal (bandera) */
            --flag-blue-dark: #00247a;    /* azul marino */
            --flag-white: #ffffff;
            --flag-red: #b71c1c;
        }

        body {
            background-color: var(--flag-white);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #222;
        }

        .navbar {
            background: linear-gradient(90deg, var(--flag-blue-dark), var(--flag-blue));
            padding: 10px 20px;
            box-shadow: 0 4px 18px rgba(0,36,102,0.07);
        }
        .navbar-brand img {
            height: 45px;
            margin-right: 10px;
        }
        .navbar-brand span {
            color: #fff;
            font-weight: bold;
            font-size: 1.3rem;
        }

        .container-main {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;
            min-height: 100vh;
            padding: 40px;
        }

        .left-side {
            width: 50%;
            text-align: left;
            padding-right: 30px;
        }
        .left-side h1 {
            font-size: 3rem;
            font-weight: bold;
            color: var(--flag-blue);
            margin-bottom: 15px;
        }
        .left-side p {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 25px;
        }
        .main-logo {
            max-width: 80%;
            margin: 0 auto 20px auto;
            display: block;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,36,102,0.05);
        }
        .slogan {
            font-size: 1.1rem;
            font-style: italic;
            color: var(--flag-blue-dark);
            margin-top: 15px;
        }

        .right-side {
            width: 40%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .btn-custom {
            width: 100%;
            margin: 10px 0;
            padding: 15px;
            font-size: 1.2rem;
            border-radius: 12px;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            font-weight: 600;
        }
        .btn-custom:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 34px rgba(0,36,102,0.08);
        }

        /* Botón azul marino */
        .btn-azul {
            background-color: var(--flag-blue-dark);
            color: #fff;
            border: none;
        }

        .btn-blanco {
            background-color: var(--flag-white);
            color: #333;
            border: 2px solid rgba(0,0,0,0.08);
        }
        .btn-rojo {
            background-color: var(--flag-red);
            color: #fff;
            border: none;
        }
        .btn-gris {
            background-color: #f1f1f1;
            color: #333;
            border: 1px solid #e0e0e0;
        }

        body::before{
            content:"";
            position:fixed;
            top:0; left:0; right:0; bottom:0;
            pointer-events:none;
            background-image: radial-gradient(circle at 10% 8%, rgba(0,51,153,0.02), transparent 8%),
                              radial-gradient(circle at 95% 95%, rgba(183,28,28,0.01), transparent 20%);
            z-index:0;
        }

        @media (max-width: 900px){
            .container-main { flex-direction: column; padding: 20px; }
            .left-side, .right-side { width: 100%; }
            .main-logo { max-width: 100%; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand d-flex align-items-center" href="index.php" style="z-index:2;">
            <img src="logo.png" alt="Logo Servipyme">
            <span>Servipyme Gramalote</span>
        </a>
        <div class="ms-auto" style="z-index:2;">
            <?php if(isset($_SESSION['nombre'])): ?>
                <a href="perfil.php" class="btn btn-light">Mi Perfil</a>
                <a href="cerrar_sesion.php" class="btn btn-outline-light">Cerrar Sesión</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container-main" style="position:relative; z-index:1;">
        <div class="left-side">
            <h1>Bienvenido</h1>
            <p>Servipyme Gramalote es un directorio local diseñado para conectar de manera directa 
                a los negocios, emprendedores, profesionales y también a personas de nuestro municipio.  
                Aquí encontrarás en un solo lugar tiendas, servicios, oficios, productos en venta y proyectos locales 
                que aportan al desarrollo económico y social de Gramalote.  
                <br><br>
                Nuestro objetivo es brindarte una herramienta sencilla y confiable para que, sin complicaciones, 
                puedas localizar rápidamente lo que necesites o conectarte con otras personas.  
                <br><br>
                Si eres emprendedor o prestador de servicios, este espacio también está hecho para ti: 
                puedes registrar tu perfil, mostrar tus productos o habilidades y hacerte visible frente 
                a toda la comunidad. De esta manera, juntos fortalecemos la economía local y construimos 
                redes de apoyo que nos benefician a todos.</p>
            
            <img src="bienvenida.jpg" alt="Imagen de bienvenida" class="main-logo">
            <div class="slogan">"Impulsando el crecimiento local con innovación y cercanía"</div>
        </div>

        <div class="right-side">
            <a href="login.php" class="btn btn-azul btn-custom">Iniciar Sesión</a>
            <a href="registro.php" class="btn btn-blanco btn-custom">Registrar mi Cuenta / Negocio / Servicio</a>
            <a href="politica-de-privacidad.php" class="btn btn-gris btn-custom">Políticas de Privacidad</a>
        </div>
    </div>
</body>
</html>