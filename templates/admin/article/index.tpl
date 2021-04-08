<div id="menu_top" style="height:3rem;width:100%;border-bottom: 1px solid #CCCCCC;"></div>
<div id="table" style="overflow:auto;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $("#table").ql_table({
            id: "ql_table",
            height: $(document).height() - 3 * 16,
            fixedHead: true,
            addButtonLink: "/admin/article/create",
            data: <?=json_encode([
        ["id" => 1, "title" => "test"],
        ["id" => 2, "title" => "test"],
        ["id" => 3, "title" => "test"],
        ["id" => 4, "title" => "test"],
        ["id" => 5, "title" => "test"],
        ["id" => 6, "title" => "test"],
        ["id" => 7, "title" => "test"],
        ["id" => 8, "title" => "test"],
        ["id" => 9, "title" => "test"],
        ["id" => 10, "title" => "test"],
        ["id" => 11, "title" => "test"],
        ["id" => 12, "title" => "test"],
        ["id" => 13, "title" => "test"],
        ["id" => 14, "title" => "test"],
        ["id" => 15, "title" => "test"],
        ["id" => 16, "title" => "test"],
        ["id" => 17, "title" => "test"],
        ["id" => 18, "title" => "test"],
        ["id" => 19, "title" => "test"],
        ["id" => 20, "title" => "test"],
        ["id" => 21, "title" => "test"],
        ["id" => 22, "title" => "test"],
        ["id" => 23, "title" => "test"],
        ["id" => 24, "title" => "test"],
        ["id" => 25, "title" => "test"],
        ["id" => 26, "title" => "test"],
        ["id" => 27, "title" => "test"],
        ["id" => 28, "title" => "test"],
        ["id" => 29, "title" => "test"],
        ["id" => 30, "title" => "test"],
            ])?>
        });
    }, false);
</script>

<style>
    table {
        width: 100%;
        height: 100%;
        overflow:auto;
        border-collapse: collapse;
    }
    table tr {
        height: 3rem;
        padding: 0 1rem;
    }
    table tr td {
        padding: 0 1rem;
    }
</style>