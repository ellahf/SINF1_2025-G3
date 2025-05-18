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
            <div class="below-navbar">
                <h1>Itens</h1>
            </div>

            <hr class="colored-line">

            <select id="" style="float: right;margin-right:1%;margin-top: 1%; margin-bottom: 0%;">
                <option value="">Ordenar:</option>
                <option value="3">Importância</option>
                <option value="6">Alfabéticamente</option>
            </select>

            <br>
            <button id="openPopupBtn" class="button">Criar novo item</button>

            <!--<button id="showDeleteFormBtn" class="button">Apagar um item</button>-->

            <!-- O Popup -->
            <div id="popupForm" class="popup">
                <div class="popup-content">
                    <span class="close-btn">&times;</span>
                    <h2>Nova Coleção</h2>
                    <form id="collectionForm" method="POST" action="" enctype="multipart/form-data">
                        <label for="itemName">Nome do item:</label>
                        <input type="text" id="itemName" name="nome" required>

                        <label for="itemDescricao">Descrição:</label>
                        <textarea type="text" id="itemDescricao" name="descricao" required>

                        <label for="itemImportancia">Importância (0-10):</label>
                        <input type="number" id="itemName" name="importancia" required>

                        <label for="itemPeso">Peso:</label>
                        <input type="text" id="itemPeso" name="peso" required>

                        <label for="itemPreço">Preço:</label>
                        <input type="text" id="itemPreco" name="preco" required>

                        <label for="itemData">Preço:</label>
                        <input type="date" id="itemData" name="data" required>

                        <label for="collectionFile">Capa da coleção (escolha um arquivo):</label>
                        <input type="file" id="collectionFile" name="imagem" accept="image/*" required>

                        <!--<input type="hidden" name="utilizador_id" value="<?php //echo $_SESSION['utilizador_id'] ?? ''; ?>">-->

                        <div id="previewContainer" style="margin-top:10px;"></div>

                        <button type="submit" name="submitColecao">Salvar</button>
                        <button type="button" id="closePopupBtn">Cancelar</button>
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