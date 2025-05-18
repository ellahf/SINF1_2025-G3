<?php
    include 'DataAccessLayer.php';
    session_start();

    $erro = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_btn'])) {
        $email = $_POST['email'];
        $senha = $_POST['password'];

        $dal = new DAL();
        $utilizador = $dal->autenticarUtilizador($email, $senha);

        if ($utilizador) {
            $_SESSION['utilizador'] = $utilizador;
            header("Location: UserInterface/colecoes.php"); // Redirecionar após login
            exit();
        } else {
            $erro = "Email ou senha inválidos.";
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
                        <a href="UserInterface/itens.php">Itens</a>
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
            <section class="register-form-section">
                <form class="user-form" method="POST" action="">                        
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" required>

                    <label for="password">Password:</label>
                    <input type="password" id="senha" name="password" required>

                    <button id="botaosubmit" type="submit" name="login_btn" value="1">Login</button>
                    <?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
                    <br>
                    <a style="color:black">Não tem conta?</a> <a href="UserInterface/registar.php">Registar</a>
                </form>
            </section>
        </main>
        
        <footer>
            <hr class="colored-line">
            <p style="text-align: center;">&copy; 2025 Portal do Colecionador. Todos os direitos reservados - Grupo3.</p>
        </footer>

        <script src="java/script.js"></script>
    </body> 

</html>