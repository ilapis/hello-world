<div id="table" style="overflow:auto;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $("#table").ql_table({
            id: "ql_table",
            height: $(document).height() - 3 * 16,
            fixedHead: true,
            addButtonLink: "/admin/category/create",
            dataUrl: "/admin/category/list"
        });
    }, false);
</script>
