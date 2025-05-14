<?php
    include 'BusinessLogicLayer.php';

    $mensagem = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $data = $_POST["data"];
        $email = $_POST["email"];
        $password = $_POST["senha"]; // Continua a usar o campo 'senha' no formulário

        $bll = new BLL();
        $mensagem = $bll->registarUtilizador($nome, $data, $email, $password);
    }
?>

<!DOCTYPE html>
<html lang="pt">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login/Registar - Portal do Colecionador</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>

    <body>
        <header>
            <div class="top-bar">
                <div class="logo""><a href="index.php">Coleção</a></div>
                <div class="search-bar">
                </div>
            </div>
            <nav class="navbar">
                <ul class="nav-links">
                    <li class="nav-item dropdown">
                        <a href="miniaturasAuto.html">Miniaturas Automotivas</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="comicBooks.html">Comic Books</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="eventos.html">Eventos</a>
                    </li>
                </ul>
            </nav>
        </header>

        <br>
            <div class="below-navbar">
                <h1>Login</h1>
            </div>
            <hr class="colored-line">

            <section class="register-form-section">
                <?php if ($mensagem): ?>
                    <p style="color: green;"><?= htmlspecialchars($mensagem) ?></p>
                <?php endif; ?>
                <form class="user-form" method="POST" action="">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>

                    <label for="data">Data:</label>
                    <input type="date" id="data" name="data" required>
            
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
            
                    <label for="senha">Palavra-passe:</label>
                    <input type="password" id="senha" name="password" required>
            
                    <button type="submit" name="submitnavbar" value="submit">Enviar</button>
                </form>
            </section>
        </main>
        
        <footer>
            <hr class="colored-line">
            <p style="text-align: center;">&copy; 2025 Portal do Colecionador. Todos os direitos reservados - Grupo3.</p>
        </footer>
        
        <script src="../java/script.js"></script>
    </body>
</html>