<?php declare(strict_types = 1);

namespace App\Abstract;

abstract class Model {

    protected false|\mysqli $db;

    public function __construct() {
        $this->db = \mysqli_connect(
            $_ENV['MYSQL_HOST'],
            $_ENV['MYSQL_USER'],
            $_ENV['MYSQL_PASSWORD'],
            $_ENV['MYSQL_DATABASE']
        );
    }

    protected function query(string $query): array
    {
        $stmt = $this->db->query($query);

        $result = [];
        while ($row = $stmt->fetch_assoc()) {
            $result[] = $row;
        }

        $stmt->free();

        return $result;
    }

    public function __deconstruct()
    {
        $this->db->close();
    }
}