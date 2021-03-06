<?php declare(strict_types = 1);

namespace App\Interfaces;

interface ModelInterface {

    function get(string $table, array $collumns = null, array $where = null): array;

    function table(string $table, array $collumns = null, array $where = null, array $filter = []): array;
}
