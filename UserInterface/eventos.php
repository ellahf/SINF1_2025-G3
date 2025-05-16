<?php
    include 'BusinessLogicLayer.php';
 

    if (isset($_POST["submit"])) {
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];
        $local = $_POST["localizacao"];
        $data = $_POST["data"];
        $imagem = $_FILES["imagem"]["name"];
        $tmp = $_FILES["imagem"]["tmp_name"];
        $destino = "imagens/" . $imagem;
        $utilizador_id = $_SESSION["id"];
        $colecao_id = $_POST["colecao_id"];

        $stmt = $mysqli->prepare("INSERT INTO evento (nome, descricao, localizacao, data, imagem, utilizador_id, colecao_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $nome, $descricao, $local, $data, $imagem, $utilizador_id, $colecao_id);

        if ($stmt->execute()) {
            move_uploaded_file($tmp, $destino);
            echo "<script>alert('Evento criado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao criar evento.');</script>";
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
                <div class="logo"><a href="../index.php">Eventos</a></div>
                <div class="search-bar">
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
                        <a href="eventos.html">Eventos</a>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="below-navbar">
                <h1>Eventos de Colecionadores</h1>
                <p>Confira os eventos que já aconteceram e os que ainda estão por vir!</p>
                <button id="openPopupBtn" class="button-new-collection">Criar evento</button>
            </div>

            <hr class="colored-line">
    
            <h2><u>Próximos Eventos</u></h2>
            <section class="future-event-section">
                <section class="collection-section">
                    <div class="collection-container">
                        <div class="event-item" id="futue-event1">
                            <img src="../imagens/feiraMiniaturas1.jpg" alt="Feira Miniaturas Automotivas" id="img1">
                            <h3 id="title">Feira Nacional de Miniaturas</h3>
                            <p id="data"><strong>Data:</strong> 20 de abril de 2025 - 10h às 18h</p></p>
                            <p id="loc"><strong>Local:</strong> Exponor - Porto International Fair</p>
                            <p id="desc">Expositores de miniaturas automotivas</p>
                        </div>     

                        <div class="event-item" id="future-event2">
                            <img src="../imagens/feiraComic1.jpg" alt="Comic Con" id="img2">
                            <h3 id="title">Comic Con</h3>
                            <p id="data"><strong>Data:</strong> 10 a 12 de maio de 2025 - 10h às 20h</p></p>
                            <p id="loc"><strong>Local:</strong> Exponor - Porto International Fair</p>
                            <p id="desc">Convenção de Comic Books.</p>
                        </div> 
                    </div>
                </section>
            </section>

            <h2><u>Eventos Passados</u></h2>
            <section class="past-event-section">
                <section class="collection-section">
                    <div class="collection-container">
                        <div class="event-item" id="past-event1">
                            <img src="../imagens/feiraComic2.jpg" alt="Feira Comic Books" id="img3">
                            <h3 id="title">Encontro de Colecionadores de Comic Books</h3>
                            <p id="data"><strong>Data:</strong> 18 de janeiro de 2025 - 13h às 19h</p></p>
                            <p id="loc"><strong>Local:</strong> Biblioteca Municipal de Matosinhos</p>
                            <p id="desc">Troca e venda de livros em quadrinhos, painéis com artistas e sessão de autógrafos.</p>
                            <div class="rating-container">
                                <span class="rating-label">Classifique:</span>
                                <span class="stars">
                                  <span class="star" data-value="1">&#9734;</span>
                                  <span class="star" data-value="2">&#9734;</span>
                                  <span class="star" data-value="3">&#9734;</span>
                                  <span class="star" data-value="4">&#9734;</span>
                                  <span class="star" data-value="5">&#9734;</span>
                                </span>
                              </div>
                        </div>

                        <div class="event-item" id="past-event2">
                            <img src="../imagens/feiraMiniaturas2.jpg" alt="Feira Comic Books" id="img3">
                            <h3 id="title">Workshop de Restauração de Miniaturas</h3>
                            <p id="data"><strong>Data:</strong> 11 de novembro de 2024 - 15h às 18h</p></p>
                            <p id="loc"><strong>Local:</strong> Ateliê do Colecionador, Lisboa</p>
                            <p id="desc">Aprenda técnicas para restaurar e conservar miniaturas.</p>
                            <div class="rating-container">
                                <span class="rating-label">Classifique:</span>
                                <span class="stars">
                                  <span class="star" data-value="1">&#9734;</span>
                                  <span class="star" data-value="2">&#9734;</span>
                                  <span class="star" data-value="3">&#9734;</span>
                                  <span class="star" data-value="4">&#9734;</span>
                                  <span class="star" data-value="5">&#9734;</span>
                                </span>
                              </div>
                        </div>
                    </div>
                </section>
            </section>

            <div id="popupForm" class="popup hidden">
                <div class="popup-content">
                    <span class="close-btn">&times;</span>
                    <h2>Login</h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="nome">Nome do Evento:</label>
                        <input type="text" name="nome" required />
                        
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" id="descricao" required></textarea>

                        <label for="localizacao">Localização:</label>
                        <input type="text" name="localizacao" id="localizacao" required>

                        <label for="data">Data:</label>
                        <input type="date" name="data" id="data" required>

                        <label for="imagem">Imagem:</label>
                        <input type="file" name="imagem" id="imagem" accept="image/*" required>

                        <label for="colecao">Coleção:</label>
                        <select name="colecao_id" id="colecao" required>
                            <?php
                            $uid = $_SESSION["id"];
                            $res = $mysqli->query("SELECT colecaoid, nome FROM colecao WHERE idUtilizador=$uid");
                            while ($r = $res->fetch_assoc()) {
                                echo "<option value='{$r['colecaoid']}'>{$r['nome']}</option>";
                            }
                            ?>
                        </select>

                        <input type="hidden" name="utilizador_id" value="<?php echo $_SESSION['id']; ?>">

                        <button type="submit" name="submit">Salvar</button>
                        <button type="button" id="closePopupBtn">Cancelar</button>
                    </form>
                </div>
            </div>
            
        </main>
    
        <footer>
            <hr class="colored-line">
            <p style="text-align: center;">&copy; 2025 Portal do Colecionador. Todos os direitos reservados - Grupo3.</p>
        </footer>

        <script src="../java/script.js"></script>
    </body>
</html>