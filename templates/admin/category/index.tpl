<div id="table" style="overflow:auto;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $("#table").ql_table({
            id: "ql_table",
            height: $(document).height() - 3 * 16 - 15,
            fixedHead: true,
            addButtonLink: "/admin/category/create",
            dataUrl: "/admin/category/list",
            filterType: "realtime",
            collumns: [
                {
                    cssStyle: {
                        head: "width: 80px;",
                    },
                    key: "id"
                },
                {
                    cssStyle: {
                        head: "width: 120px;",
                        collumn: "text-align: center;"
                    },
                    key: "enabled",
                    render: function (row, value) {

                        let style = 'style="margin:auto;margin-top: 0.25rem;"';
                        let checked = "";

                        if ( value == "1") {
                            checked = `checked="checked"`;
                        }

                        return `
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" ${checked}" ${style} >
                        </div>
                        `;

                    }
                },
                {
                    cssStyle: {
                        collumn: "text-align: left;"
                    },
                    key: "title"
                },
                {
                    cssStyle: {
                        head: "width: 224px;",
                        collumn: "text-align: center;"
                    },
                    key: "id",
                    title: "",
                    render: function (row, value) {
                        return `
                        <a class="btn btn-primary" href="/admin/category/edit/${value}" ><i class="bi bi-pencil-square"></i> Edit</a>
                        <a class="btn btn-danger" href="/admin/category/delete/${value}" ><i class="bi bi-trash"></i> Delete</a>
                        `;
                    }
                }
            ]
        });
    }, false);
</script>
