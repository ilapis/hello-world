<div id="breadcrumb">
    <span style="width: calc(300px - 1rem);float:left;display: block;">Admin | Builder | Form | List</span>
    <a href="/admin/builder/form/create" style="float:right;display: block;text-indent:0rem;right: 0.875rem;position: relative;margin-top: 0.875rem;" class="btn btn-primary"><i class="bi bi-plus-circle"></i></a>
</div>

<div id="table" style="overflow:auto;margin:0.5rem;    box-shadow: 0 10px 10px rgb(0 0 0 / 19%), 0 6px 6px rgb(0 0 0 / 23%);"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $("#table").ql_table({
            id: "ql_table",
            height: $(document).height() - 3 * 16 - 16 * 5 - 7,
            fixedHead: true,
            dataUrl: "/admin/builder/form/list",
            collumns: [
                {
                    cssStyle: {
                        head: "width: 80px;",
                    },
                    key: "id"
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
                        <a class="btn btn-primary" href="/admin/builder/form/edit/${value}" ><i class="bi bi-pencil-square"></i> Edit</a>
                        <a class="btn btn-danger" href="/admin/builder/form/delete/${value}" ><i class="bi bi-trash"></i> Delete</a>
                        `;
                    }
                }
            ]
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