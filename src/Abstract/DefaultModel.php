<?php declare(strict_types = 1);

namespace App\Abstract;

class DefaultModel extends Model {

    public function get(string $table, array $collumns = null, array $where = null): array
    {
        return $this->query(
            "SELECT " . $this->collumns($collumns) . " FROM $table " . $this->where($where)
        )[0];
    }

    public function getList(string $table, array $collumns = null, array $where = null, array $filter = []): array
    {
        $filter = htmlspecialchars($filter["orderBy"] ?? "", ENT_HTML5);

        return [
            "data" => $this->query(
                "SELECT " . $this->collumns($collumns) . " FROM $table " . $this->where($where) . " " . $filter
            ),
            "metadata" => [],
            "filter" => $filter,
        ];
    }

    public function saveRecord(string $table, array $data): array
    {
        unset($data["id"]);
        $array_keys = array_keys($data);
        $array_values = array_values($data);
        $query = "INSERT INTO `" . $table . "` (`" . implode("`, `", $array_keys) . "`) VALUES ('" . implode("', '", $array_values) . "');";

        $this->query($query);

        $data["id"] = $this->getLastInsertedId();

        $response = [
            "status"    => "ok",
            "action"    => "modal",
            "modal"     => "modal-inserted",
            "message"   => "record inserted",
            "data"      => $data,
        ];

        return $response;
    }

    public function updateRecord(string $table, array $data): array
    {
        $querySet = "";
        foreach ( $data as $collumn => $value) {
            if ( $querySet == "" ) {
                $querySet = "`" . $collumn . "` = '" . $value . "'";
            } else {
                $querySet = $querySet . ", `" . $collumn . "` = '" . $value . "'";
            }
        }

        $query = "UPDATE `" . $table . "` SET " . $querySet . " WHERE id = " . (int) $data["id"] . ";";

        $this->query($query);

        $response = [
            "status"    => "ok",
            "action"    => "modal",
            "modal"     => "modal-updated",
            "message"   => "record updated",
            "data"      => $data,
        ];

        return $response;
    }

    private function where($where):string {

        $partial_where = "";

        if ( $where !== null && !empty($where) ) {
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

        return $partial_where;
    }

    private function collumns($collumns): string {

        $partial_collumns = "";

        if ( $collumns !== null ) {
            foreach ($collumns as $collumn) {
                if ($partial_collumns == "") {
                    $partial_collumns = "`" . strtr($collumn, ["`" => "\`"]) . "`";
                } else {
                    $partial_collumns .= ", `" . strtr($collumn, ["`" => "\`"]) . "`";
                }
            }
        }

        return $partial_collumns;
    }
}