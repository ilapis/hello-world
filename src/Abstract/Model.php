<?php declare(strict_types = 1);

namespace App\Abstract;

abstract class Model implements \App\Interfaces\ModelInterface {

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
        $stmt = false;

        if ( $this->db ) {
            $stmt = $this->db->query($query);
        }

        $result = [];

        if ( $stmt instanceof \mysqli_result ) {
            while ($row = $stmt->fetch_assoc()) {
                $result[] = $row;
            }

            $stmt->free();
        }


        return $result;
    }

    public function __deconstruct()
    {
        if ( $this->db ) {
            $this->db->close();
        }
    }
}