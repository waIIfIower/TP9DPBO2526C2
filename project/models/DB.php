<?php

class DB
{
    private string $host = 'localhost';
    private string $dbname = 'mvp_kandidat_db';
    private string $username = 'root';
    private string $password = '';
    protected ?PDO $conn = null;
    private ?PDOStatement $result = null;

    public function __construct()
    {
        $this->open();
    }

    public function open(): void
    {
        if ($this->conn === null) {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        }
    }

    public function executeQuery(string $query, array $params = []): void
    {
        $this->open();
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        $this->result = $stmt;
    }

    public function getAllResult(): array
    {
        if ($this->result === null) {
            return [];
        }
        return $this->result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function close(): void
    {
        $this->result = null;
        $this->conn = null;
    }
}
