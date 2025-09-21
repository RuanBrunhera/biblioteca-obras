<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Obras.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'] ?? '';
        $autor = $_POST['autor'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $inicio = $_POST['inicio'] ?? '';
        $fim = $_POST['fim'] ?? '';
        $status = $_POST['status'] ?? '';

        $obra = new Obras($conn);
        $obra->id = $id;
        $obra->titulo = $titulo;
        $obra->autor = $autor;
        $obra->descricao = trim($descricao);
        $obra->inicio = $inicio;
        $obra->fim = $fim;
        $obra->status = $status;
        $resultado = $obra->editar();
    }

    if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo '<p style="color: red; text-align: center;">ID de obra inválido.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de obras</a></p>';
        exit;
    } 


    $id = $_GET['id'];

    $obra = new Obras($conn);
    $obra_atual = $obra->consultarPorId( $id);

    if (!$obra_atual) {
        echo '<p style="color: red; text-align: center;">Obra não encontrada.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de obras</a></p>';
        exit;
    }
    
?>
    
    <div class="form-container">
        <h1>Editar Obra</h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($obra_atual['id']); ?>">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($obra_atual['titulo']) ?>" required>
            </div>
            <div class="form-group">
                <label for="titulo">Autor:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($obra_atual['autor']) ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required><?php echo htmlspecialchars($obra_atual['descricao']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="inicio">Data de Início:</label>
                <input type="date" id="inicio" name="inicio" value="<?php echo htmlspecialchars($obra_atual['inicio']) ?>" required>
            </div>
            <div class="form-group">
                <label for="fim">Data de Fim:</label>
                <input type="date" id="fim" name="fim" value="<?php echo htmlspecialchars($obra_atual['fim']) ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="pendente" <?php echo ($obra_atual['status']==='pendente') ? 'selected' : ''; ?>>Pendente</option>
                    <option value="em andamento"  <?php echo ($obra_atual['status']==='em andamento') ? 'selected' : ''; ?>>Em Andamento</option>
                    <option value="concluida"  <?php echo ($obra_atual['status']==='concluida') ? 'selected' : ''; ?>>Concluída</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Editar Obra</button>
            </div>
            <?php
            if (isset($resultado)) {
                if ($resultado) {
                    echo '<p style="color: green; text-align: center;">Obra alterada com sucesso!</p>';
                } else {
                    echo '<p style="color: red; text-align: center;">Erro ao alterar obra. Tente novamente.</p>';
                }
            }  
            ?>
        </form>
    </div>
