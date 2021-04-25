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
        global $g_error_code;

        $stmt = false;

        if ( $this->db ) {
            $stmt = $this->db->query($query);
            if( $stmt === false ){
                file_put_contents("/var/www/html/logs/php.log", getErrorCode() . PHP_EOL . $this->db->error . PHP_EOL . $query . PHP_EOL, FILE_APPEND);;
            }
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