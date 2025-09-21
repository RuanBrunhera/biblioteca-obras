<title>Listar Obras</title>
    </style>
    <div class="container">
        <h1>Listar Obras</h1>
        <form action="" method="post" class="search-form">
            <input type="search" name="buscar" id="buscar" value="<?php echo htmlspecialchars($_POST['buscar'] ?? ''); ?>" placeholder="Buscar obra...">
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Descricao</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Situação</th>
                <th>Criação</th>
                <th>Alteração</th>
                <th style="width: 120px;">Ação</th>
            </tr>
            <?php
            require_once __DIR__ . '/../data/connection.php';
            require_once __DIR__ . '/../model/Obras.php';
            // *** Se queiser saber mais, descomente as linhas abaixo para depuração (debugging)
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
                echo "<td>" . htmlspecialchars($item['descricao']) . "</td>";
                echo "<td>" . htmlspecialchars($item['inicio']) . "</td>";
                echo "<td>" . htmlspecialchars($item['fim']) . "</td>";
                echo "<td>" . htmlspecialchars($item['status']) . "</td>";
                echo "<td>" . htmlspecialchars($item['createAt']) . "</td>";
                echo "<td>" . htmlspecialchars($item['updateAt']) . "</td>";
                echo "<td><a href='?page=editar&id=" . $item['id'] . "'>Editar</a> | <a href='?page=deletar&id=" . $item['id'] . "' onclick=\"return confirm('Tem certeza que deseja deletar esta obra?');\">Deletar</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>