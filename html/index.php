<?php 
    session_start();
    var_dump($_SESSION);
    include 'BusinessLogicLayer.php';    

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login_submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $bll = new BLL();
        $utilizador = $bll->autenticarUtilizador($email, $password);

        if ($utilizador) {
            $_SESSION["id"] = $utilizador["id"];
            $_SESSION["utilizador"] = $utilizador;

            header("Location: index.php");
            exit();
        } else {
            $erroLogin = "Email ou palavra-passe incorretos.";
        }
    }

?>



<!DOCTYPE html>
<html lang="pt">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Portal do Colecionador</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>

    <body>
        <header>
            <div class="top-bar">
                <div class="logo" href="index.php">Portal do Colecionador</div>
                <div class="search-bar">
                    <?php if (isset($_SESSION["utilizador"])): ?>
                        <a href="perfil.php">Perfil</a>
                    <?php else: ?>
                        <button id="openPopupBtn">Login</button>
                    <?php endif; ?>

                </div>
            </div>

            <!-- O Popup -->
            <div id="popupForm" class="popup">
                <div class="popup-content">
                    <span class="close-btn">&times;</span>
                    <h2>Login</h2>
                    <form id="collectionForm" method="POST" action="index.php">
                        <label for="">Email:</label>
                        <input type="text" id="email" name="email" required>

                        <label for="descricaoColecao">Password:</label><br>
                        <input type="password" id="password" name="password" required>

                        <button id="butaosubmit" type="submit" name="login_submit" value="submit">Login</button>
                        <a style="color:black">Não tem conta?</a> <a href="registar.php">Registar</a>
                    </form>  
                </div>
            </div>

            <nav class="navbar">
                <ul class="nav-links">
                    <li class="nav-item dropdown">
                        <a href="index.php">Início</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="colecoes/miniaturasAuto.html">Miniaturas Automotivas</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="colecoes/comicBooks.html">Comic Books</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="eventos.php">Eventos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="colecoes.php">Coleções</a>
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
                                <img src="../imagens/comicBook1.jpg" alt="Comic Book - Avengers">
                                <h3>Avengers</h3>
                            </div>
                            <div class="collection-item">
                                <img src="../imagens/comicBook2.jpg" alt="The X-Men">
                                <h3>The X-Men</h3>
                            </div>
                            <div class="collection-item">
                                <img src="../imagens/comicBook3.jpg" alt="Hulk & Batman">
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
                                <img src="../imagens/automotiva1.jpg" alt="Mini-cooper">
                                <h3>Mini-cooper</h3>
                            </div>
                            <div class="collection-item">
                                <img src="../imagens/automotiva2.jpg" alt="Volkswagen Fusca">
                                <h3>Volkswagen Fusca</h3>
                            </div>
                            <div class="collection-item">
                                <img src="../imagens/automotiva3.jpg" alt="McLaren">
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

        <script src="../java/script.js"></script>
    </body> 

</html>