<?php declare(strict_types = 1);

namespace App\Abstract;

use App\Abstract\Model;

class DefaultModel extends Model {

    public function get(string $table, array $collumns = null, array $where = null): array
    {
        $partial_where = "";
        if ( $where !== null) {
            foreach ( $where as $collumn => $value ) {

                if ( is_string($value) ) {
                    $value = strtr($value, ["'" => "\'"]);
                }

                if ( $partial_where == "" ) {
                    $partial_where = "WHERE `" . strtr($collumn, ["`" => "\`"]) . "` = '" . $value . "'";
                } else {
                    $partial_where .= " AND `" . strtr($collumn, ["`" => "\`"]) . "` = '" . $value. "'";
                }
            }
        }

        $partial_collumns = "";
        foreach ( $collumns as $collumn ) {
            if ( $partial_collumns == "" ) {
                $partial_collumns = "`" . strtr($collumn, ["`" => "\`"]) . "`";
            } else {
                $partial_collumns .= ", `" . strtr($collumn, ["`" => "\`"]) . "`";
            }
        }

        $query = "SELECT $partial_collumns FROM $table $partial_where ";

        return $this->query($query);
    }

}