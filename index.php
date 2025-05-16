<?php
    session_start();
    include "DataAccessLayer.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login_btn'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $dal = new DAL();
        $utilizador = $dal->autenticarUtilizador($email, $password);


        if ($utilizador) {
            // Login bem-sucedido
            $_SESSION['utilizador_id'] = $utilizador['id'];
            $_SESSION['utilizador_nome'] = $utilizador['nome'];
            echo "<script>alert('Login bem-sucedido!'); window.location.href='index.php';</script>";
            exit;
        } else {
            // Falha no login
            echo "<script>alert('Email ou senha incorretos.');</script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="pt">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Portal do Colecionador</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <header>
            <div class="top-bar">
                <div class="logo" href="index.php">Portal do Colecionador</div>
                <div class="search-bar">
                    <button id="openPopupBtn">Login</button>
                </div>
            </div>

            <!-- O Popup -->
            <div id="popupForm" class="popup">
                <div class="popup-content">
                    <form id="collectionForm" method="POST" action="index.php">
                        <span class="close-btn">&times;</span>
                        <h2>Login</h2>
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" required>

                        <label for="password">Password:</label><br>
                        <input type="password" id="password" name="password" required>

                        <button id="botaosubmit" type="submit" name="login_btn" value="1">Login</button>
                        <br><br>
                        <a style="color:black">Não tem conta?</a> <a href="UserInterface/registar.php">Registar</a>
                    </form>
                </div>
            </div>

            <nav class="navbar">
                <ul class="nav-links">
                    <li class="nav-item dropdown">
                        <a href="index.php">Início</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="UserInterface/colecoes.php">Coleções</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="UserInterface/eventos.php">Eventos</a>
                    </li>
                </ul>
            </nav>
        </header>

        <main>
            <div class="below-navbar">
                <h1 class="below-navbar-h1">Bem-vindo</h1>
            </div>

            <hr class="colored-line">
            <section>
                <div class="below-line">
                    <h2>Coleções mais visualizadas</h2>
                    <section class="collection-section">
                        <h2>Comic Books</h2>
                        <div class="collection-container">
                            <div class="collection-item">
                                <img src="imagens/comicBook1.jpg" alt="Comic Book - Avengers">
                                <h3>Avengers</h3>
                            </div>
                            <div class="collection-item">
                                <img src="imagens/comicBook2.jpg" alt="The X-Men">
                                <h3>The X-Men</h3>
                            </div>
                            <div class="collection-item">
                                <img src="imagens/comicBook3.jpg" alt="Hulk & Batman">
                                <h3>Hulk & Batman</h3>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="below-line">
                    <section class="collection-section">
                        <h2>Miniaturas de Automotivas</h2>
                        <div class="collection-container">
                            <div class="collection-item">
                                <img src="imagens/automotiva1.jpg" alt="Mini-cooper">
                                <h3>Mini-cooper</h3>
                            </div>
                            <div class="collection-item">
                                <img src="imagens/automotiva2.jpg" alt="Volkswagen Fusca">
                                <h3>Volkswagen Fusca</h3>
                            </div>
                            <div class="collection-item">
                                <img src="imagens/automotiva3.jpg" alt="McLaren">
                                <h3>McLaren</h3>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </main>
        
        <footer>
            <hr class="colored-line">
            <p style="text-align: center;">&copy; 2025 Portal do Colecionador. Todos os direitos reservados - Grupo3.</p>
        </footer>

        <script src="java/script.js"></script>
    </body> 

</html>