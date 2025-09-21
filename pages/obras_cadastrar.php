<?php

    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Obras.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'] ?? '';
        $autor = $_POST['autor'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $inicio = $_POST['inicio'] ?? '';
        $fim = $_POST['fim'] ?? '';
        $status = $_POST['status'] ?? '';

        $obra = new Obras($conn);
        $obra->titulo = $titulo;
        $obra->autor = $autor;
        $obra->descricao = $descricao;
        $obra->inicio = $inicio;
        $obra->fim = $fim;
        $obra->status = $status;
        $resultado = $obra->cadastrar();
    }
?>
    <div class="form-container">
        <h1>Cadastrar Nova Obra</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="titulo">Autor:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="inicio">Data de Início:</label>
                <input type="date" id="inicio" name="inicio" required>
            </div>
            <div class="form-group">
                <label for="fim">Data de Fim:</label>
                <input type="date" id="fim" name="fim" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="pendente">Pendente</option>
                    <option value="em andamento">Em Andamento</option>
                    <option value="concluida">Concluída</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar Obra</button>
            </div>
            <?php
            if (isset($resultado)) {
                if ($resultado) {
                    echo '<p style="color: green; text-align: center;">Obra cadastrada com sucesso!</p>';
                } else {
                    echo '<p style="color: red; text-align: center;">Erro ao cadastrar obra. Tente novamente.</p>';
                }
            }  
            ?>
        </form>
    </div>
