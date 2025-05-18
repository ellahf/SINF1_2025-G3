<?php
    session_start();
    include '../BusinessLogicLayer.php';

    //if (!isset($_SESSION['utilizador'])) {
      //  header("Location: ../index.php");
        //exit();
    //}

    $bll = new BLL();   
    $eventos = $bll->obterTodosEventos();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['criarEvento'])) {
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $localizacao = $_POST['localizacao'] ?? '';
        $data = $_POST['data'] ?? '';
        $colecoes_id = intval($_POST['colecoes_id'] ?? 0);

        // Processar upload da imagem
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['imagem']['tmp_name'];
            $nome_arquivo = basename($_FILES['imagem']['name']);
            $destino = '../imagens/' . $nome_arquivo;

            if (move_uploaded_file($tmp_name, $destino)) {
                $imagem = $destino;

                // Inserir no banco
                $resultado = $bll->criarEvento($nome, $descricao, $localizacao, $data, $imagem, $colecoes_id);

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
        $evento_id = intval($_POST['evento_id']);

        if ($evento_id > 0) {
            // Chama a função para deletar o evento
            $deletado = $bll->apagarEvento($evento_id);

            if ($deletado) {
                echo "<script>alert('Evento excluído com sucesso!'); location.href='eventos.php';</script>";
                exit; // interrompe para evitar continuar a execução
            } else {
                echo "<script>alert('Erro ao excluir evento.');</script>";
            }
        } else {
            echo "<script>alert('ID do evento inválido.');</script>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitEdicao'])) {
        $evento_id = intval($_POST['evento_id']);
        $nome = trim($_POST['nome']);
        $descricao = trim($_POST['descricao']);
        $data = $_POST['data'];
        $localizacao = trim($_POST['localizacao']);
        $colecoes_id = intval($_POST['colecoes_id']);
        $imagem = null;

        // Verifica se foi enviada uma nova imagem
        if (!empty($_FILES['imagem']['name'])) {
            $target_dir = "../imagens/";
            $target_file = $target_dir . basename($_FILES["imagem"]["name"]);

            if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                $imagem = $target_file;
            }
        }

        // Chama a função para editar
        $resultado = $bll->editarEvento($evento_id, $nome, $descricao, $data, $localizacao, $colecoes_id, $imagem);

        if ($resultado) {
            header("Location: eventos.php?msg=evento_editado");
            exit;
        } else {
            echo "<script>alert('Erro ao editar evento.');</script>";
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
                <div class="logo"><a href="eventos.php">Eventos</a></div>
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

            <br>

            <button id="showCreateEventForm" type="button">Criar evento</button>

            <form id="createEventForm" method="POST" action="" enctype="multipart/form-data" style="display: none; margin-top: 1rem; margin-right: 50%;">
                <input type="hidden" id="create-evento-id" name="evento_id" value="" />

                <label>Nome:</label>
                <input type="text" id="create-nome" name="nome" required><br>

                <label>Descrição:</label>
                <textarea id="create-descricao" name="descricao" required></textarea><br>

                <label>Localização:</label>
                <input type="text" id="create-localizacao" name="localizacao" required><br>

                <label>Data:</label>
                <input type="date" id="create-data" name="data" required><br>

                <label>Imagem:</label>
                <input type="file" id="create-imagem" name="imagem"><br>

                <label>Coleção:<br>
                    <select id="create-colecoes_id" name="colecoes_id" required>
                        <?php $bll->setDropBoxOptionsColecao(); ?>
                    </select>
                </label>
                
                <br><br>

                <button type="submit" name="criarEvento">Guardar</button>
                <br><br>
            </form>


            <button id="showDeleteFormBtn" type="button">Apagar evento</button>

           
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
                        <?php
                            $id = (int) $evento['evento_id'];
                            $nome = htmlspecialchars($evento['nome'], ENT_QUOTES);
                            $descricao = htmlspecialchars($evento['descricao'], ENT_QUOTES);
                            $data = $evento['data'];
                            $localizacao = htmlspecialchars($evento['localizacao'], ENT_QUOTES);
                            $imagem = htmlspecialchars($evento['imagem'], ENT_QUOTES);
                            $colecoes_id = (int) $evento['colecoes_id'];
                        ?>
                        <div class="event-item">
                            <?php $id = (int) $evento['evento_id']; ?>
                            <img src="../uploads/<?php echo htmlspecialchars($evento['imagem']); ?>" alt="Imagem do evento">
                            <h3><?php echo htmlspecialchars($evento['nome']); ?></h3>
                            <p><?php echo htmlspecialchars($evento['descricao']); ?></p>
                            <p><strong>Data:</strong> <?php echo $evento['data']; ?></p>
                            <p><strong>Local:</strong> <?php echo htmlspecialchars($evento['localizacao']); ?></p>
                            <p><strong>Coleção:</strong>  <?php echo htmlspecialchars($bll->obterNomeColecaoPorId($evento['colecoes_id'])); ?></p>
                            <button onclick="abrirModalEdicaoEvento(<?= $id ?>,'<?= $nome ?>','<?= $descricao ?>','<?= $data ?>','<?= $localizacao ?>','<?= $imagem ?>',<?= $colecoes_id ?>)">Editar</button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <div id="modal-editar-evento" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="fecharModalEdicaoEvento()">&times;</span>
                    <h2>Editar Evento</h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="evento_id" id="edit-evento-id">

                        <label>Nome:</label><br>
                        <input type="text" name="nome" id="edit-nome"><br>

                        <label>Descrição:</label><br>
                        <textarea name="descricao" id="edit-descricao"></textarea><br>

                        <label>Data:</label><br>
                        <input type="date" name="data" id="edit-data"><br

                        <label>Localização:</label><br>
                        <input type="text" name="localizacao" id="edit-localizacao"><br>

                        <label>Imagem:</label><br>
                        <input type="file" name="imagem" id="edit-imagem"><br>

                        <label>Coleção:</label><br>
                        <select name="colecoes_id" id="edit-colecoes-id">
                            <?php $bll->setDropBoxOptionsColecao() ?>
                        </select>

                        <button type="submit" name="submitEdicao">Salvar</button>
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