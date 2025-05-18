<?php
    session_start();
    include '../BusinessLogicLayer.php'; // ajuste o caminho

    $bll = new BLL();
    $colecoes = $bll->obterTodasColecoes();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitColecao'])) {
        $nome = $_POST['nome'] ?? '';
        $tipo = $_POST['tipo'] ?? '';
        //$utilizador_id = intval($_POST['utilizador_id'] ?? 0);

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['imagem']['tmp_name'];
            $nome_arquivo = basename($_FILES['imagem']['name']);
            $destino = '../imagens/' . uniqid() . '_' . $nome_arquivo;

            if (move_uploaded_file($tmp_name, $destino)) {
                $imagem = $destino;

                // Função na DAL para criar coleção
                $resultado = $bll->criarColecao($nome, $tipo, $imagem);

                echo $resultado ? "Coleção criada com sucesso!" : "Erro ao criar coleção.";
                header("Location: colecoes.php"); // Redirecionar após login
                exit();
            } else {
                echo "Erro ao salvar a imagem.";
            }
        } else {
            echo "Erro no upload da imagem.";
        }

    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluirColecao'])) {
        $colecoes_id = intval($_POST['colecoes_id'] ?? 0);

        if ($colecoes_id > 0) {
            $apagado = $bll->apagarColecao($colecoes_id);
            if ($apagado) {
                echo "<script>alert('Coleção apagada com sucesso!'); window.location.href='colecoes.php';</script>";
                exit();
            } else {
                echo "<script>alert('Erro ao apagar a coleção.');</script>";
            }
        } else {
            echo "<script>alert('Coleção inválida.');</script>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitEdicao'])) {
        $colecoes_id = intval($_POST['colecoes_id']);       // pega o id que está no hidden
        $nome = trim($_POST['nome']);
        $tipo = trim($_POST['tipo']);
        $imagem = null;

        // Se estiver enviando imagem, tratar o upload (exemplo simplificado)
        if (!empty($_FILES['imagem']['name'])) {
            // Tratamento do upload, salvando a imagem no servidor e pegando o caminho/filename
            // Aqui só um exemplo genérico:
            $target_dir = "../imagens/";  // pasta para salvar imagens
            $target_file = $target_dir . basename($_FILES["imagem"]["name"]);

            if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                $imagem = $target_file;  // caminho para passar na função
            }
            
        }

        // Chamar a função editarColecao da DAL
        $resultado = $bll->editarColecao($colecoes_id, $nome, $tipo, $imagem);

        if ($resultado) {
            // sucesso: pode redirecionar ou mostrar mensagem
            header("Location: colecoes.php?msg=editado_sucesso");
            exit;
        } else {
            // erro ao editar
            $erro = "Erro ao atualizar a coleção.";
        }
    }


?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Coleções</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>

    <body>
        <header>
            <div class="top-bar">
                <div class="logo"><a href="colecoes.php">Coleção</a></div>
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

        <select id="" style="float: right;margin-right:1%;margin-top: 1%; margin-bottom: 0%;">
            <option value="">Ordenar:</option>
            <option value="3">Importância</option>
            <option value="6">Alfabéticamente</option>
        </select>

        <br>
        <button id="openPopupBtn" class="button">Criar nova coleção</button>

        <button id="showDeleteFormBtn" class="button">Apagar uma coleção</button>

        <!-- O Popup -->
        <div id="popupForm" class="popup">
            <div class="popup-content">
                <span class="close-btn">&times;</span>
                <h2>Nova Coleção</h2>
                <form id="collectionForm" method="POST" action="" enctype="multipart/form-data">
                    <label for="collectionName">Nome da Coleção:</label>
                    <input type="text" id="collectionName" name="nome" required>

                    <label for="collectionTipo">Tipo da Coleção:</label>
                    <input type="text" id="collectionTipo" name="tipo" required>

                    <label for="collectionFile">Capa da coleção (escolha um arquivo):</label>
                    <input type="file" id="collectionFile" name="imagem" accept="image/*" required>

                    <!--<input type="hidden" name="utilizador_id" value="<?php //echo $_SESSION['utilizador_id'] ?? ''; ?>">-->

                    <div id="previewContainer" style="margin-top:10px;"></div>

                    <button type="submit" name="submitColecao">Salvar</button>
                    <button type="button" id="closePopupBtn">Cancelar</button>
                </form>              
            </div>
        </div>

        <form id="deleteEventForm" method="POST" action="" style="display: none; margin-top: 1rem;">
            <label for="colecao">Nome da coleção a apagar:</label>
            <select name="colecoes_id" id="colecao">
                <?php $bll->setDropBoxOptionsColecao() ?>
            </select>

            <button type="submit" name="excluirColecao">Confirmar Apagar</button>
        </form>

        <section class="colecoes-lista">
            <div class="collection-container">
                <?php foreach ($colecoes as $colecao): ?>
                    <?php
                        $nome = htmlspecialchars($colecao['nome'], ENT_QUOTES);
                        $tipo = htmlspecialchars($colecao['tipo'], ENT_QUOTES);
                        $imagem = htmlspecialchars($colecao['imagem'], ENT_QUOTES);
                    ?>
                    <div class="collection-item">
                        <img src="../imagens/<?php echo htmlspecialchars($colecao['imagem']); ?>" alt="Imagem da coleção">
                        <h3><?php echo htmlspecialchars($colecao['nome']); ?></h3>
                        <p><?php echo htmlspecialchars($colecao['tipo']); ?></p>
                        <!--<a href="colecao.php?id=<?php // echo $colecao['colecao_id']; ?>"></a>-->
                        <br>
                        <?php $id = (int) $colecao['colecoes_id']; ?>
                        <button onclick="abrirModalEdicao(<?= (int) $colecao['colecoes_id'] ?>, '<?= $nome ?>', '<?= $tipo ?>', '<?= $imagem ?>')">Editar</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <div id="modal-editar-colecao" class="modal">
            <div class="modal-content">
                <span class="close" onclick="fecharModalEdicao()">&times;</span>
                <h2>Editar Coleção</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="colecoes_id" id="edit-id">

                    <label>Nome:</label><br>
                    <input type="text" name="nome" id="edit-nome"><br><br>

                    <label>Tipo:</label><br>
                    <input type="text" name="tipo" id="edit-tipo"><br><br>

                    <label>Nova imagem:</label><br>
                    <input type="file" name="imagem" id="edit-imagem" accept="image/*"><br><br>

                    <button type="submit" name="submitEdicao">Salvar</button>
                </form>
            </div>
        </div>
        
        <footer>
            <hr class="colored-line">
            <p style="text-align: center;">&copy; 2025 Portal do Colecionador. Todos os direitos reservados - Grupo3.</p>
        </footer>

        <script src="../java/script.js"></script>
    </body>
    
</html>