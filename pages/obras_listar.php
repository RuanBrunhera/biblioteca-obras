<title>Listar Obras</title>
</style>
<div class="container">
    <h1>Listar Obras</h1>
    <form action="" method="post" class="search-form">
        <input type="search" name="buscar" id="buscar" value="<?php echo htmlspecialchars($_POST['buscar'] ?? ''); ?>" placeholder="Buscar obra...">
    </form>
    
    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Descrição</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Situação</th>
                <th>Criação</th>
                <th>Alteração</th>
                <th style="width: 140px;">Ação</th>
            </tr>
            <?php
            require_once __DIR__ . '/../data/connection.php';
            require_once __DIR__ . '/../model/Obras.php';
            
            // Função para formatar data para padrão brasileiro
            function formatarDataBR($data) {
                if (!$data || $data === '0000-00-00') {
                    return '-';
                }
                
                $dataObj = DateTime::createFromFormat('Y-m-d', $data);
                if ($dataObj) {
                    return $dataObj->format('d/m/Y');
                }
                
                $dataObj = DateTime::createFromFormat('Y-m-d H:i:s', $data);
                if ($dataObj) {
                    return $dataObj->format('d/m/Y H:i');
                }
                
                return $data;
            }
            
            // *** Se quiser saber mais, descomente as linhas abaixo para depuração (debugging)
            // var_dump($conn);
            // var_dump(__DIR__ . '/../data/connection.php');
            // var_dump(__DIR__ . '/../model/Tarefas.php');
            
            $obra = new Obras($conn);
            $lista = $obra->consultarTodos(htmlspecialchars($_POST['buscar'] ?? ''));

            foreach ($lista as $item) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($item['id']) . "</td>";
                echo "<td>" . htmlspecialchars($item['titulo']) . "</td>";
                echo "<td>" . htmlspecialchars($item['autor']) . "</td>";
                
                // Exibir descrição completa
                echo "<td>" . htmlspecialchars($item['descricao']) . "</td>";
                
                // Usando a função para formatar a data pro padrão brasileiro
                echo "<td>" . formatarDataBR($item['inicio']) . "</td>";
                echo "<td>" . formatarDataBR($item['fim']) . "</td>";
                
                $statusClass = str_replace(' ', '-', strtolower($item['status']));
                echo "<td class='status $statusClass'>" . htmlspecialchars($item['status']) . "</td>";
                
                // Mesma coisa do início e fim, formatar a data pro BR
                echo "<td>" . formatarDataBR($item['createAt']) . "</td>";
                echo "<td>" . formatarDataBR($item['updateAt']) . "</td>";
                
                // Botões de ação estilizados
                echo "<td>";
                echo "<div class='actions'>";
                echo "<a href='?page=editar&id=" . $item['id'] . "' class='btn-edit'>✏️ Editar</a>";
                echo "<a href='/pages/obras_deletar.php?id=" . $item['id'] . "' class='btn-delete' onclick=\"return confirm('Tem certeza que deseja deletar esta obra?');\">🗑️ Deletar</a>";
                echo "</div>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>