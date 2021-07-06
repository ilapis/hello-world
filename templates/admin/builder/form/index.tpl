<div id="breadcrumb">
    <span style="width: calc(300px - 1rem);float:left;display: block;">Admin | Builder | Form | List</span>
    <a href="/admin/builder/form/create" style="float:right;display: block;text-indent:0rem;right: 0.875rem;position: relative;margin-top: 0.875rem;" class="btn btn-primary"><i class="bi bi-plus-circle"></i></a>
</div>

<div id="table"></div>

<script>
    let optionCheckboxes = {
        buttons: [
            {action: 'filter', className: "bi bi-filter"},
            {action: 'archive', className: "bi bi-archive"},
            {action: 'delete', className: "bi bi-trash"}
        ],
        action: function (element, action, options) {
            console.log(element, action, options);
            if ( action == "filter") {

                if ( $(element).find(".table-pagination").hasClass("filter-enabled") ) {
                    $(element).find(".table-pagination").removeClass("filter-enabled");
                } else {
                    $(element).find(".table-pagination").addClass("filter-enabled");
                }

                if ( $(element).find(".filter").hasClass("filter-enabled") ) {
                    $(element).find(".filter").removeClass("filter-enabled");
                } else {
                    $(element).find(".filter").addClass("filter-enabled");
                }

                if ( $(element).find(".wrapper-sticky").hasClass("filter-enabled") ) {
                    $(element).find(".wrapper-sticky").removeClass("filter-enabled");
                } else {
                    $(element).find(".wrapper-sticky").addClass("filter-enabled");
                }

                if ( $(element).find(".table_buttons").hasClass("filter-enabled") ) {
                    $(element).find(".table_buttons").removeClass("filter-enabled");
                } else {
                    $(element).find(".table_buttons").addClass("filter-enabled");
                }
            }
        }
    };

    let collumn_id = {
        cssStyle: {
            head: "width: 80px;",
            collumn: "width: 3rem;text-indent:1.25rem;",
        },
        key: "id",
        title: "Id"
    };

    let collumn_title = {
        cssStyle: {
            collumn: "text-align: left;"
        },
        key: "title",
        title: "Title"
    };

    let collumn_buttons = {
        cssStyle: {
            head: "width: 180px;",
            collumn: "text-align: center;"
        },
        key: "id",
        title: "",
        render: function (row, value) {

            let deleteSettings = {
                "type": "modal-confirm",
                "message": "Ar ištrinti?",
                "method": "delete",
                "link": "/admin/builder/form/delete/${value}",
                "data": {"id": value}
            };

            return `
            <a class="btn btn-primary" href="/admin/builder/form/edit/${value}" ><i class="bi bi-pencil-square"></i> Edit</a>
            <button class="btn btn-danger" data-popup='${JSON.stringify(deleteSettings)}'><i class="bi bi-trash"></i></button>
            `;
        }
    };

    document.addEventListener('DOMContentLoaded', function () {

        var bft = $("#table").ql_table({
            id: "ql_table",
            height: $(window).height() - 3 * 16 - 16 * 5 - 7,
            fixedHead: true,
            dataUrl: "/admin/builder/form/list",
            filterType: "realtime",
            search: true,
            optionCheckboxes: optionCheckboxes,
            optionFilter: {},
            collumns: [
                collumn_id,
                collumn_title,
                collumn_buttons
            ]
        });

        $(document).on("click", "#modal-confirm-button", function() {
            let settings = $(this).data("settings");
            postData( settings.link, settings.method, settings.data ).then(response => {
                modal_confirm.hide();
                responseHandler(response);
                bft.redraw();
            });
        });

    }, false);
</script>
