<?php
    include "ligacao.php";

    function adicionarEvento($mysqli, $dados, $file) {
        $imagem = $file["name"];
        $tmp = $file["tmp_name"];
        $destino = "imagens/" . $imagem;

        $query = "INSERT INTO evento (nome, descricao, data, dataFim, local, imagem, colecaoid) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssssi", $dados["nome"], $dados["descricao"], $dados["data"], $dados["dataFim"], $dados["local"], $imagem, $dados["colecao"]);

        if ($stmt->execute()) {
            move_uploaded_file($tmp, $destino);
            return true;
        }

        return false;
    }

    function editarEvento($mysqli, $id, $dados, $file) {
        $imagem = $file["name"];
        $tmp = $file["tmp_name"];
        $destino = "imagens/" . $imagem;

        $query = "UPDATE evento SET nome=?, descricao=?, data=?, dataFim=?, local=?, imagem=?, colecaoid=? WHERE cod_evento=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssssii", $dados["nome"], $dados["descricao"], $dados["data"], $dados["dataFim"], $dados["local"], $imagem, $dados["colecao"], $id);

        if ($stmt->execute()) {
            move_uploaded_file($tmp, $destino);
            return true;
        }

        return false;
    }

    function excluirEvento($mysqli, $id) {
        return $mysqli->query("DELETE FROM evento WHERE cod_evento=$id");
    }

?>