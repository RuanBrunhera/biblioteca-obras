<?php
class Obras
{
    // Atributos correspondentes à tabela de tarefas
    public $id;
    public $titulo;
    public $autor;
    public $descricao;
    public $inicio;
    public $fim;
    public $status;
    
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    // Método para cadastrar uma nova tarefa
    public function cadastrar(): bool
    {
        try {
            $sql = "INSERT INTO Obras (`titulo`, `autor`, `descricao`, `inicio`, `fim`, `status`) VALUES (?, ? ,?, ?, ?, ?)";
            $dados = [
                $this->titulo,
                $this->autor,
                $this->descricao,
                $this->inicio,
                $this->fim,
                $this->status
            ];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dados);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao cadastrar obra: " . $e->getMessage());
            throw new Exception(message: "Erro ao cadastrar obra: " . $e->getMessage());
        }
    }

    // Método para consultar todas as tarefas, com busca opcional
    public function consultarTodos($search = '')
    {
        try {            
            if ($search) {
                $sql = "SELECT * FROM Obras WHERE titulo LIKE ? OR autor LIKE ?";
                $search = trim(string: $search);
                $search = "%{$search}%";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$search, $search]);
            } else {
                $sql = "SELECT * FROM Obras";
                $stmt = $this->conn->query($sql);
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar obras: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar obras: " . $e->getMessage());
        }
    }

    // Método para consultar tarefa por ID
    public function consultarPorId($id)
    {
        try {
            $sql = "SELECT * FROM Obras WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar obra por ID: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar obra por ID: " . $e->getMessage());
        }
    }

    // Método para alterar uma tarefa existente
    public function editar()
    {
        try {
            $sql = "UPDATE Obras SET titulo = ?, autor = ?, descricao = ?, inicio = ?, fim = ?, status = ? WHERE id = ?";
            $dados = [
                $this->titulo,
                $this->descricao,
                $this->autor,
                $this->inicio,
                $this->fim,
                $this->status,
                $this->id
            ];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dados);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao alterar obra: " . $e->getMessage());
            throw new Exception(message: "Erro ao alterar obra: " . $e->getMessage());
        }
    }

    // Método para deletar uma tarefa
    public function deletar($id): bool
    {
        try {
            $sql = "DELETE FROM Obras WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao deletar obra: " . $e->getMessage());
            throw new Exception(message: "Erro ao deletar obra: " . $e->getMessage());
        }
    }
}