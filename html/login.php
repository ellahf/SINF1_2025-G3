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
                <div class="logo""><a href="index.html">Coleção</a></div>
                <div class="search-bar">
                    <input type="text" placeholder="Search...">
                    <button>Search</button>
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
            
            <section class="login-form-section">
                <form class="user-form" onsubmit="return validarFormulario()">
            
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
            
                    <label for="senha">Palavra-passe:</label>
                    <input type="password" id="senha" name="senha" required>
            
                    <button type="submit">Enviar</button>

                    <p>Não tem conta? Clique <a href="#" id="mostrar-registro">aqui</a> para se registar.</p>
                </form>
            </section>

            <br>

            <section class="register-form-section">
                <form class="user-form" onsubmit="return validarFormulario()">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>

                    <label for="data">Data:</label>
                    <input type="date" id="data" name="data" required>
            
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
            
                    <label for="senha">Palavra-passe:</label>
                    <input type="password" id="senha" name="senha" required>
            
                    <label for="confirmarSenha">Confirmar Palavra-passe:</label>
                    <input type="password" id="confirmarSenha" name="confirmarSenha" required>
            
                    <button type="submit">Enviar</button>
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