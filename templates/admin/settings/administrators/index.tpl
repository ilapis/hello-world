<div id="table" style="overflow:auto;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $("#table").ql_table({
            id: "ql_table",
            height: $(document).height() - 3 * 16 - 15,
            fixedHead: true,
            addButtonLink: "/admin/settings/administrators/create",
            data: <?=json_encode($model)?>,
            collumns: [
                {
                    head: {
                        cssStyle: "width: 60px;"
                    },
                    key: "id"
                },
                {
                    head: {
                        cssStyle: "width: 60px;"
                    },
                    cssStyle: "text-align: center;",
                    key: "enabled",
                    render: function (row, value) {
                        return "<input type='checkbox' />";
                    }
                },
                {
                    key: "username"
                },
                {
                    head: {
                        cssStyle: "width: 120px;"
                    },
                    key: "id",
                    title: "",
                    render: function (row, value) {
                        return `<a class="btn btn-primary" href="/admin/settings/administrators/edit/${value}" >Edit</a>`;
                    }
                }
            ]
        });
    }, false);
</script>
