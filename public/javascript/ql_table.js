(function( $ ) {

    $.fn.ql_table = function( options ) {

        let table = this;
        let  filter = {"page": 1, "per_page": 15,"orderBy": "", "search": "", "searchIn": []};
        let  initial_ws = $(window).height();

        if ( options.filterType == undefined ) {
            options.filterType = "data";
            //realtime - make request to url
            //data - filter from loaded data
        }

        if ( options.dataUrl !== undefined ) {

            _getDataFromUrl(options, filter);
        } else {
            _get(this, options);
        }

        data_table_action( $(this).attr('id') );

        $.fn.redraw = function () {
            if ( options.dataUrl !== undefined ) {
                _getDataFromUrl(options, filter);
            } else {
                _get(this, options);
            }
        }

        $(document).on("click", "#" + $(this).attr('id') + " .page-item", function() {
            if ( !$(this).attr("disabled") && filter.page != $(this).data("page") ) {
                filter.page = $(this).data("page");
                table.redraw();
            }
        });

        return this;

        function data_table_action( table_id ) {
            $(document).on('click', "#"+table_id+" [data-table-action]", function () {
                let selected = [];
                $("#" + table_id + " [name=selected_id]:checked").each( function ( index, data ) {
                    selected[index] = $(this).val();
                });
                options.optionCheckboxes.action( $(this).data('table-action'), selected );
            });

        }

        function _get(data, options) {

            $(data)
                .html(`
                    ${_get_buttons()}
                    ${_get_table(options)}
                    ${_get_pagination_row()}
                `)
                .css({"height": options.height + 'px'})
            ;

            $(`#${options.id}`).sticky({
                "top": "tbody tr:first-child"
            });


            setHeight(options, data);
            $(window).on('resize', function(){
                setHeight(options, data);
            });

            function setHeight(options, data) {

                $(data).find(".wrapper-sticky").each(function () {
                    let dataHeight = 0;
                    let bodyHeight = options.height - 2 - 3 * 16 - 8;

                    if (undefined !== options.data) {
                        dataHeight = (options.data.length + 1) * 48;
                    } else {
                        height = bodyHeight;
                    }

                    let height = dataHeight;

                    if (bodyHeight < dataHeight) {
                        height = bodyHeight;
                    }

                    if ( options.optionCheckboxes != undefined ) {
                        bodyHeight = bodyHeight - 48;
                    }

                    let diff = $(window).height() - initial_ws;
                    $(this).height(bodyHeight + diff);
                    $(this).find("table").height(height + diff);

                    $(data)
                        .css({"height": options.height  + diff + 'px'})
                    ;

                });
            }

            $(document).off("click", "[data-sort]");
            $(document).on("click", "[data-sort]", function () {

                if ( options.filterType == "data") {
                    console.log(options.data);
                }

                if ( options.filterType == "realtime") {
                    if ($(this).hasClass("bi-sort-up-alt")) {
                        $(this).removeClass("bi-sort-up-alt").addClass("bi-sort-down");
                        filter.orderBy = "ORDER BY " + $(this).data("sort") + " DESC";
                    } else {
                        $(this).removeClass("bi-sort-down").addClass("bi-sort-up-alt");
                        filter.orderBy = "ORDER BY " + $(this).data("sort") + " ASC";
                    }

                    _getDataFromUrl(options, filter);
                }

            })

        }

        function _getDataFromUrl(options, filter) {
            getData(options.dataUrl + "?filter=" + JSON.stringify(filter)).then(json => {
                options.data = json.data;
                options.metadata = json.metadata;
                _get(table, options);
            });
        }

        function _get_buttons() {

            if ( options.optionCheckboxes !== undefined ) {

                let buttons = "";

                $(options.optionCheckboxes.buttons).each( function (index, data) {
                    buttons = buttons + `<div class="btn btn-default" data-table-action="${data.action}"><i class="${data.className}"></i></div>`;
                } );

                return `<div id="table_buttons" >${buttons}</div>`;
            }

            return ``;
        }

        function _get_table( options ) {

            let data = options.data;

            if ( data !== undefined ) {
                return `
                <table id="${options.id}">
                    ${_get_body_rows(data)}
                </table>
                `;
            }
        }

        function _get_pagination_row() {

            let page_total = 0;
            let page = 1;
            let next = "disabled";
            let prev = "disabled";

            if ( options.metadata !== undefined  && options.data.length < parseInt(options.metadata.records_total) ) {
                page_total = Math.ceil( parseInt(options.metadata.records_total) / 10.0);
            } else {
                page_total = Math.ceil(options.data.length / 10.0);
            }

            if ( options.metadata !== undefined  && 0 < parseInt(options.metadata.records_total) ) {
                page = parseInt(options.metadata.records_page);
            } else {
                page = filter.page;
            }

            if ( page > 1 ) {
                prev = `data-page="${page - 1}"`
            }
            if ( page < page_total - 1 ) {
                next = `data-page="${page + 1}"`
            }

            let buttons = "";
            for ( i = 1; i < page_total; ++i) {
                let active = "";
                if ( page == i ) {
                    active = "active";
                }
                buttons = buttons + `<li class="page-item ${active}" data-page="${i}"><a class="page-link" href="#">${i}</a></li>`;
            }

            return `
                    <div style="height:3rem;width:100%;">
                        <nav aria-label="...">
                          <ul class="pagination" style="    margin:0.5rem 1rem;">
                            <li class="page-item" ${prev}>
                              <a class="page-link" href="#">Previous</a>
                            </li>
                            ${buttons}
                            <li class="page-item" ${next}>
                              <a class="page-link" href="#">Next</a>
                            </li>
                          </ul>
                        </nav>
                    </div>
            `;
        }

        function _get_body_rows(data) {

            let template = "";

            if ( options.collumns !== undefined ) {

                let cell = "";

                if ( options.optionCheckboxes !== undefined ) {
                    cell = cell + `
                        <td style="height:3rem;width:3rem;">
                            <span>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" >
                                </div>
                            </span>
                        </td>`;
                }

                Object.keys(options.collumns).forEach( colrow => {

                    if ( data[0] !== undefined) {

                        if (data[0][options.collumns[colrow].key] !== undefined) {

                            let title = options.collumns[colrow].key;
                            let cssStyle = "";

                            if (options.collumns[colrow].title !== undefined) {
                                title = options.collumns[colrow].title;
                            }

                            if (options.collumns[colrow].cssStyle !== undefined && options.collumns[colrow].cssStyle.head !== undefined) {
                                cssStyle = options.collumns[colrow].cssStyle.head;
                            }

                            let sort_icon = "bi bi-sort-down";
                            let sort_data = `data-sort="${title}"`;

                            if (filter.orderBy == `ORDER BY ${title} DESC`) {
                                sort_icon = "bi bi-sort-down";
                                sort_data = `data-sort="${title}"`;
                            }

                            if (filter.orderBy == `ORDER BY ${title} ASC`) {
                                sort_icon = "bi bi-sort-up-alt";
                                sort_data = `data-sort="${title}"`;
                            }

                            if (title == "") {
                                sort_icon = "";
                                sort_data = "";
                            }

                            cell = cell + `
                        <td style="height:3rem;${cssStyle}">
                            <i class="${sort_icon}" ${sort_data}></i>
                            <span>${title}</span>
                        </td>`;
                        }
                    }
                });

                template = template + `<tr class="c_0"  style="line-height:1.5rem;height:3rem;">${cell}</tr>` ;

                for (let i = 0; i < data.length; i++ ) {
                    let cell = "";
                    let cssStyle = "";

                    if ( options.optionCheckboxes !== undefined ) {
                        cell = cell + `<td style="height:3rem;width:3rem;">
                            <span>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="selected_id" value="${data[i].id}" >
                                </div>
                            </span>
                        </td>`;
                    }

                    Object.keys(options.collumns).forEach( colrow => {
                        if ( data[i][options.collumns[colrow].key] !== undefined ) {
                            if (  options.collumns[colrow].cssStyle !== undefined && options.collumns[colrow].cssStyle.collumn !== undefined ) {
                                cssStyle = options.collumns[colrow].cssStyle.collumn ;
                            }
                            if ( options.collumns[colrow].render !== undefined ) {
                                cell = cell + `<td style="height:3rem;text-indent: 1.25rem;${cssStyle}">` + options.collumns[colrow].render( data[i], data[i][options.collumns[colrow].key] )+ `</td>`;
                            } else {
                                cell = cell + `<td style="height:3rem;text-indent: 1.25rem;${cssStyle}">` + data[i][options.collumns[colrow].key] + `</td>`;
                            }
                        }
                    });

                    template = template + `<tr class="c_${i+1}"> ` + cell + `</tr>` ;
                }

            } else {
                if ( data[0] !== undefined ) {
                    let cell = "";

                    Object.keys(data[0]).forEach(row => {
                        cell = cell + `<td style="height:3rem;">` + row + `</td>`;
                    });

                    template = template + `<tr class="c_0"  style="line-height:1.5rem;height:3rem;">${cell}</tr>`;

                    for (let i = 0; i < data.length; i++) {
                        let cell = "";

                        Object.keys(data[i]).forEach(row => {
                            cell = cell + `<td style="height:3rem;">` + data[i][row] + `</td>`
                        });

                        template = template + `<tr class="c_${i + 1}"> ` + cell + `</tr>`;
                    }
                }
            }

            return template;
        }

        async function getData(url = '', method = 'GET') {
            const response = await fetch(url, {
                method: method,
                mode: 'cors',
                cache: 'no-cache',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json'
                },
                redirect: 'follow',
                referrerPolicy: 'no-referrer'
            });

            return response.json();
        }

    };

}( jQuery ));
