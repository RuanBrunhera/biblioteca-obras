<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="css/estilo.css">
    <script>
    function limparParametrosURL() {
        if (window.location.search) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    }
</script>
</head>
<body>
    <nav>
        <a href="?page=cadastrar" style="text-decoration: none; color: #ffffffff; font-weight: bold;">Cadastrar nova obra</a>
        <a href="?page=listar" style="text-decoration: none; color: #ffffffff; font-weight: bold;">Listar obra</a>
    </nav>
    <div id="container" style="height: calc(98vh - 50px); overflow-y: auto; padding: 20px; box-sizing: border-box;">
        <?php
            if (isset($_GET['page']) && $_GET['page'] === 'cadastrar') {
                require_once __DIR__ . '/pages/obras_cadastrar.php';
            } 
            elseif (isset($_GET['page']) && $_GET['page'] === 'editar') {
                require_once __DIR__ . '/pages/obras_editar.php';
            }
            elseif (isset($_GET['page']) && $_GET['page'] === 'deletar') {
                require_once __DIR__ . '/pages/obras_deletar.php';
            }
            else {
                require_once __DIR__ . '/pages/obras_listar.php';
                if(isset($_GET['deleted']) && $_GET['deleted'] === 'true') {
                    echo '<script> alert("Obra deletada com sucesso."); limparParametrosURL();</script>';
                }
            }
        ?>
    </div>
</body>
</html>

