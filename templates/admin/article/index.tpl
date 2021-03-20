<div id="menu_top" style="height:3rem;width:100%;border-bottom: 1px solid #CCCCCC;"></div>
<div id="table" style="overflow:auto;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $("#table").ql_table({
            id: "ql_table",
            height: $(document).height() - 3 * 16,
            fixedHead: true
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