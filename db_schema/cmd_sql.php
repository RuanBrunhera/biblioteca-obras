<?php
require_once __DIR__ .'/../data/db_config.php';

$deleteDB = 'DROP DATABASE IF EXISTS '.DB_NAME.';';
$criarDB = 'CREATE DATABASE IF NOT EXISTS '.DB_NAME.';';
$usarDB = 'USE '.DB_NAME.';';


$crearTabela = "
    CREATE TABLE IF NOT EXISTS Obras 
    (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255) NOT NULL,
        autor VARCHAR(255) NOT NULL,
        descricao TEXT,
        inicio DATE,
        fim DATE,
        `status` ENUM('pendente', 'em andamento', 'concluida') DEFAULT 'pendente',
        createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updateAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );";
        
    $insertDados = "
        INSERT INTO Obras (titulo, autor, descricao, inicio, fim, `status`) VALUES
        ('Mona Lisa', 'Leonardo da Vinci', 'Retrato enigmático de uma mulher com um sorriso sutil, considerada a pintura mais famosa do mundo.', '1503-01-01', '1519-05-02', 'concluida'),
        ('Liberdade Guiando o Povo', 'Eugène Delacroix', 'Pintura alegórica da Revolução de Julho na França, simbolizando a luta pela liberdade.', '1830-07-01', '1830-10-01', 'concluida'),
        ('O Grito', 'Edvard Munch', 'Obra expressionista que retrata angústia e desespero em uma figura gritando sob um céu vermelho.', '1893-01-01', '1893-01-01', 'concluida'),
        ('A Noite Estrelada', 'Vincent van Gogh', 'Pintura pós-impressionista que mostra o céu noturno turbulento sobre uma vila tranquila.', '1889-06-01', '1889-06-18', 'concluida'),
        ('A Criação de Adão', 'Michelangelo', 'Fresco do teto da Capela Sistina representando Deus dando vida a Adão.', '1511-01-01', '1512-10-31', 'concluida'),
        ('O Nascimento de Vênus', 'Sandro Botticelli', 'Pintura renascentista que representa a deusa Vênus emergindo do mar em uma concha.', '1484-01-01', '1486-01-01', 'concluida'),
        ('A Última Ceia', 'Leonardo da Vinci', 'Representação da última refeição de Jesus com seus apóstolos antes da crucificação.', '1495-01-01', '1498-01-01', 'concluida');
        ";
        


        

$pdo = null;
try {
    var_dump(DB_HOST ,DB_USER ,DB_PASS);
    // Conexão inicial sem banco de dados
    $pdo = new PDO(
        dsn: 'mysql:host='.DB_HOST, username: DB_USER, password: DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Deletar banco de dados se existir
    $pdo->exec(statement: $deleteDB);

    // Criar banco de dados
    $pdo->exec(statement: $criarDB);
    // Selecionar banco de dados
    $pdo->exec(statement: $usarDB);

    // Criar tabela
    $pdo->exec($crearTabela);

    // Inserir dados   
    $pdo->exec(statement: $insertDados);

    echo "Banco de dados, tabela e dados criados com sucesso!";
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
