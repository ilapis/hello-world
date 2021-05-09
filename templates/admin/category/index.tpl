<div id="table" style="overflow:auto;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $("#table").ql_table({
            id: "ql_table",
            height: $(document).height() - 3 * 16,
            fixedHead: true,
            addButtonLink: "/admin/category/create",
            dataUrl: "/admin/category/list",
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

                        if ( value == "1") {

                            return `
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked="checked" style="margin:auto;margin-top: 0.25rem;">
                            </div>`;
                        }

                        return `
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" style="margin:auto;margin-top: 0.25rem;">
                            </div>`;
                    }
                },
                {
                    cssStyle: "text-align: left;",
                    key: "title"
                },
                {
                    head: {
                        cssStyle: "width: 170px;"
                    },
                    key: "id",
                    title: "",
                    cssStyle: "text-align: center;",
                    render: function (row, value) {
                        return `
                        <a class="btn btn-primary" href="/admin/category/edit/${value}" >Edit</a>
                        <a class="btn btn-danger" href="/admin/category/delete/${value}" >Delete</a>
                        `;
                    }
                }
            ]
        });
    }, false);
</script>
