<?php
    session_start();
    include '../BusinessLogicLayer.php';

    $bll = new BLL();
    $itens = $bll->obterTodosItens();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitItem'])) {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $importancia = $_POST['importancia'];
        $peso = $_POST['peso'];
        $preco = $_POST['preco'];
        $data_aquisicao = $_POST['data_aquisicao'];
        $colecao_id = $_POST['colecao_id'];
        $imagem = null;

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['imagem']['tmp_name'];
            $nome_arquivo = basename($_FILES['imagem']['name']);
            $destino = '../imagens/' . uniqid() . '_' . $nome_arquivo;
            move_uploaded_file($tmp_name, $destino);
            $imagem = $destino;
        }

        $bll->criarItem($colecao_id, $nome, $descricao, $importancia, $peso, $preco, $data_aquisicao, $imagem);
        header("Location: itens.php?msg=criado");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitEdicaoItem'])) {
        $item_id = $_POST['item_id'];
        $colecao_id = $_POST['colecao_id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $importancia = $_POST['importancia'];
        $peso = $_POST['peso'];
        $preco = $_POST['preco'];
        $data_aquisicao = $_POST['data_aquisicao'];
        $imagem = null;

        if (!empty($_FILES['imagem']['name']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['imagem']['tmp_name'];
            $nome_arquivo = basename($_FILES['imagem']['name']);
            $destino = '../imagens/' . uniqid() . '_' . $nome_arquivo;
            if (move_uploaded_file($tmp_name, $destino)) {
                $imagem = $destino;
            }
        }

        $resultado = $bll->editarItem($item_id, $colecao_id, $nome, $descricao, $importancia, $peso, $preco, $data_aquisicao, $imagem);

        if ($resultado) {
            header("Location: itens.php?msg=sucesso");
            exit;
        } else {
            echo "Erro ao editar item.";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['excluirItem'])) {
        $item_id = (int) $_POST['item_id'];
        if ($bll->apagarItem($item_id)) {
            header("Location: itens.php?mensagem=Item apagado com sucesso");
            exit();
        } else {
            echo "<script>alert('Erro ao apagar item');</script>";
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
                <div class="logo"><a href="itens.php">Itens</a></div>
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

            <select id="" style="float: right;margin-right:1%;margin-top: 1%; margin-bottom: 0%;">
                <option value="">Ordenar:</option>
                <option value="3">Importância</option>
                <option value="6">Alfabéticamente</option>
                <option value="9">Preço</option>
            </select>

            <button id="mostrarFormularioItem">Criar novo item</button>

            <div id="formularioItem" style="display: none; margin-top: 20px; margin-right: 50%;">
                <form method="POST" action="" enctype="multipart/form-data">
                    <label>Nome:</label><br>
                    <input type="text" name="nome" required><br>

                    <label>Descrição:</label><br>
                    <textarea name="descricao" required></textarea><br>

                    <label>Importância (1 a 10):</label><br>
                    <input type="number" name="importancia" min="1" max="10" required><br>

                    <label>Peso (g):</label><br>
                    <input type="number" step="1" name="peso"><br>

                    <label>Preço (€):</label><br>
                    <input type="number" step="0.01" name="preco"><br>

                    <label>Data de Aquisição:</label><br>
                    <input type="date" name="data_aquisicao"><br>

                    <label>Imagem:</label><br>
                    <input type="file" name="imagem" accept="image/*"><br>

                    <label>Coleção:</label><br>
                    <select name="colecao_id">
                        <?php $bll->setDropBoxOptionsColecao(); ?>
                    </select><br><br>

                    <button type="submit" name="submitItem">Salvar</button>
                    <br><br>
                </form>
            </div>

            <button id="showDeleteFormBtn" type="button">Apagar evento</button>

            <form id="deleteItemForm" method="POST" action="" style="display: none; margin-top: 1rem;">
                <label for="item_id">Nome evento a apagar:</label>
                <select name="item_id" id="item">
                    <?php $bll->setDropBoxOptionsItens() ?>
                </select>

                <button type="submit" name="excluirItem">Confirmar Apagar</button>
            </form> 

            <section class="itens-lista">
                <div class="collection-container">
                    <?php foreach ($itens as $item): ?>
                        <?php
                            $id = (int) $item['item_id'];
                            $colecao_id = (int) $item['colecao_id'];
                            $nome = htmlspecialchars($item['nome'], ENT_QUOTES);
                            $descricao = htmlspecialchars($item['descricao'], ENT_QUOTES);
                            $importancia = (int) $item['importancia'];
                            $peso = (float) $item['peso']; // assumindo que o valor está em gramas
                            $preco = (float) $item['preco'];
                            $data_aquisicao = $item['data_aquisicao'];
                            $imagem = htmlspecialchars($item['imagem'], ENT_QUOTES);
                        ?>
                        <div class="item-card">
                            <?php $id = (int) $item['item_id']; ?>
                            <img src="../imagens/<?php echo htmlspecialchars($item['imagem']); ?>" alt="Imagem do item">
                            <h3><strong>Nome:</strong> <?php echo htmlspecialchars($item['nome']); ?></h3>
                            <p><strong>Descrição:</strong> <?php echo htmlspecialchars($item['descricao']); ?></p>
                            <p><strong>Importância:</strong> <?php echo htmlspecialchars($item['importancia']); ?></p>
                            <p><strong>Peso:</strong> <?php echo htmlspecialchars($item['peso']); ?> g</p>
                            <p><strong>Preço:</strong> €<?php echo number_format($item['preco'], 2, ',', '.'); ?></p>
                            <p><strong>Data de Aquisição:</strong> <?php echo htmlspecialchars($item['data_aquisicao']); ?></p>
                            <button onclick="abrirModalEdicaoItem(<?= $item['item_id'] ?>,'<?= addslashes($item['nome']) ?>','<?= addslashes($item['descricao']) ?>',<?= $item['importancia'] ?>,<?= $item['peso'] ?>,<?= $item['preco'] ?>,'<?= $item['data_aquisicao'] ?>',<?= $item['colecao_id'] ?>)">Editar</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <div id="modal-editar-item" class="modal" style="display:none;">
                <div class="modal-content">
                    <span onclick="document.getElementById('modal-editar-item').style.display='none'" class="close">&times;</span>
                    <form action="itens.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="edit-item-id" name="item_id">
                    <input type="hidden" id="edit-colecao-id" name="colecao_id">
                    
                    <label>Nome:</label>
                    <input type="text" id="edit-nome" name="nome" required>

                    <label>Descrição:</label>
                    <textarea id="edit-descricao" name="descricao"></textarea>

                    <label>Importância:</label>
                    <input type="number" id="edit-importancia" name="importancia" required>

                    <label>Peso (g):</label>
                    <input type="number" step="1" id="edit-peso" name="peso" required>

                    <label>Preço (€):</label>
                    <input type="number" step="0.01" id="edit-preco" name="preco" required>

                    <label>Data de Aquisição:</label>
                    <input type="date" id="edit-data" name="data_aquisicao" required>

                    <label>Nova imagem (opcional):</label>
                    <input type="file" name="imagem">

                    <button type="submit" name="submitEdicaoItem">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </main>
    </body>

    <footer>
        <hr class="colored-line">
        <p style="text-align: center;">&copy; 2025 Portal do Colecionador. Todos os direitos reservados - Grupo3.</p>
    </footer>

    <script src="../java/script.js"></script>

</html>