<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Obras.php';

    
    if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo '<p style="color: red; text-align: center;">ID de obra inválido.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de obras</a></p>';
        exit;
    } 


    $id = $_GET['id'];

    $obra = new Obras($conn);
    $obra_atual = $obra->consultarPorId( $id);

    if (!$tarefa_atual) {
        echo '<p style="color: red; text-align: center;">Obra não encontrada.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de obras</a></p>';
        exit;
    }

    $resultado = $obra->deletar($id);

    if ($resultado) {               
        header('Location: /?deleted=true');
    } else {
        echo '<p style="color: red; text-align: center;">Erro ao deletar obra. Tente novamente.</p>';
         echo '<p style="text-align: center;"><a href="/">Voltar para a lista de obras</a></p>';
    }