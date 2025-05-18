<?php
    session_start();
    include '../DataAccessLayer.php';

    //if (!isset($_SESSION['utilizador'])) {
      //  header("Location: ../index.php");
        //exit();
    //}

    $dal = new DAL();   
    $eventos = $dal->getAllEventos();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitnavbar'])) {
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $localizacao = $_POST['localizacao'] ?? '';
        $data = $_POST['data'] ?? '';
        $colecoes_id = intval($_POST['colecoes_id'] ?? 0);
        $utilizador_id = intval($_POST['utilizador_id'] ?? 0);

        // Processar upload da imagem
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['imagem']['tmp_name'];
            $nome_arquivo = basename($_FILES['imagem']['name']);
            $destino = 'uploads/' . $nome_arquivo;

            if (move_uploaded_file($tmp_name, $destino)) {
                $imagem = $destino;

                // Inserir no banco
                $resultado = $dal->criarEvento($nome, $descricao, $localizacao, $data, $imagem, $colecoes_id);

                echo $resultado ? "Evento criado com sucesso!" : "Erro ao criar evento.";
            } else {
                echo "Erro ao salvar imagem.";
            }
        } else {
            echo "Erro no upload da imagem.";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitExcluir'])) {
        // Pega o id do evento do POST e converte para inteiro
        $evento_id = intval($_POST['excluir_id']);

        if ($evento_id > 0) {
            // Chama a função para deletar o evento
            $deletado = $dal->deletarEvento($evento_id);

            if ($deletado) {
                echo "<script>alert('Evento excluído com sucesso!'); location.href='colecoes.php';</script>";
                exit; // interrompe para evitar continuar a execução
            } else {
                echo "<script>alert('Erro ao excluir evento.');</script>";
            }
        } else {
            echo "<script>alert('ID do evento inválido.');</script>";
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
            </div>
            <nav class="navbar">
                <ul class="nav-links">
                    <li class="nav-item dropdown">
                        <a href="colecoes.php">Coleções</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="itens.php">Itens</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="eventos.php">Eventos</a>
                    </li>
                </ul>
            </nav>
        </header>
        
        <main>
            <div class="below-navbar">
                <h1>Eventos</h1>
            </div>

            <hr class="colored-line">

            <!--<button id="openCreateEventBtn" type="button">Criar evento</button>-->

            <!--<button id="showDeleteFormBtn" type="button">Apagar evento</button>-->

            <!-- Botão para abrir modal -->
            <button id="openCreateEventBtn">Criar Evento</button>

            <!-- Modal criar evento -->
            <div id="modal-editar-colecao" class="modal">
                <div class="modal-content">
                    <button id="closeCreateEventBtn" style="position:absolute; top:10px; right:10px;">X</button>
                    <h2>Criar Evento</h2>
                    <form id="createEventForm">
                        <input type="hidden" id="create-evento-id" name="evento_id" value="" />
                        <label>Nome:<br><input type="text" id="create-nome" name="nome" required></label><br><br>
                        <label>Descrição:<br><textarea id="create-descricao" name="descricao" required></textarea></label><br><br>
                        <label>Localização:<br><input type="text" id="create-localizacao" name="localizacao" required></label><br><br>
                        <label>Data:<br><input type="date" id="create-data" name="data" required></label><br><br>
                        <label>Imagem URL:<br><input type="file" id="create-imagem" name="imagem"></label><br><br>
                        <label>Coleção:<br>
                            <select id="create-colecoes_id" name="colecoes_id" required>
                                <?php $bll->setDropBoxOptionsColecao() ?>
                            </select>
                        </label><br><br>
                        <button type="submit" name="criarEvento">Guardar</button>
                    </form>
                </div>
            </div>

            <form id="deleteEventForm" method="POST" action="" style="display: none; margin-top: 1rem;">
                <label for="evento_id">Nome evento a apagar:</label>
                <select name="evento_id" id="evento">
                    <?php $bll->setDropBoxOptionsEventos() ?>
                </select>

                <button type="submit" name="submitExcluir">Confirmar Apagar</button>
            </form>         

            <section class="eventos-lista">
                <div class="collection-container">
                    <?php foreach ($eventos as $evento): ?>
                        <div class="event-item">
                            <?php $id = (int) $colecao['evento_id']; ?>
                            <img src="../uploads/<?php echo htmlspecialchars($evento['imagem']); ?>" alt="Imagem do evento">
                            <h3><?php echo htmlspecialchars($evento['nome']); ?></h3>
                            <p><?php echo htmlspecialchars($evento['descricao']); ?></p>
                            <p><strong>Data:</strong> <?php echo $evento['data']; ?></p>
                            <p><strong>Local:</strong> <?php echo htmlspecialchars($evento['localizacao']); ?></p>
                        </div>
                    <?php endforeach; ?>
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