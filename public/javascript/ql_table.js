(function( $ ) {

    $.fn.ql_table = function( options ) {

        var  filter = {"orderBy": "", "search": "", "searchIn": []};

        return this.each( function (index, data)  {

            if ( options.dataUrl !== undefined ) {
                getData(options.dataUrl + "?filter=" + JSON.stringify(filter) ).then(json => {
                    options.data = json.data;
                    _get(data, options);
                });
            } else {
                _get(data, options);
            }
        } );

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

            $(data).find(".wrapper-sticky").each(function () {

                let dataHeight = 0;
                let bodyHeight = options.height - 2 - 3 * 16 - 6 * 16 - 8;

                if (undefined !== options.data) {
                    dataHeight = (options.data.length + 1) * 48;
                } else {
                    height = bodyHeight;
                }

                let height = dataHeight;

                if (bodyHeight < dataHeight) {
                    height = bodyHeight;
                }

                $(this).height(bodyHeight);
                $(this).find("table").height(height);

            });

            $(document).off("click", "[data-sort]");
            $(document).on("click", "[data-sort]", function () {

                if ($(this).hasClass("bi-sort-up")) {
                    $(this).removeClass("bi-sort-up").addClass("bi-sort-down");
                    filter.orderBy = "ORDER BY " + $(this).data("sort") + " DESC";
                } else {
                    $(this).removeClass("bi-sort-down").addClass("bi-sort-up");
                    filter.orderBy = "ORDER BY " + $(this).data("sort") + " ASC";
                }

                getData(options.dataUrl + "?filter=" + JSON.stringify(filter) ).then(json => {
                    options.data = json.data;
                    _get(data, options);
                });
            })

        }

        function _get_buttons() {

            if ( options.addButtonLink !== undefined ) {
                return `
                <div style="height:calc(3rem - 1px);width:100%;">
                    <a href="${options.addButtonLink}" class="btn btn-primary" style="
                        margin: 2.5rem 1.25rem 0 0.5rem;
                        height: 3.5rem;
                        width: 3.5rem;
                        border-radius: 3rem;
                        margin-top: -4.25rem;
                        position: absolute;
                        right: 0;"><i class="fs-2 bi bi-plus" style="line-height: 2.5rem;display: block;right: 1px;position: relative;"></i></a>
                        
                        <div class="row"  style="margin: 2.5rem 0rem 1rem 1rem;">
                        <div class="col-sm-6">
                            <button class="btn btn-default" style="border: 1px solid #CCCCCC;float: left;">Export</button>
                        </div>
                        
                        <div class="col-sm-6">
                        <div class="input-group mb-3" style="right: 0.5rem;">
                          <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search">
                          <button class="btn btn-outline-secondary" type="button" id="search">Search</button>
                        </div></div>
                        </div>
                        
                </div>
                `;
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

            return `
                    <div style="height:3rem;width:100%;">
                        <nav aria-label="...">
                          <ul class="pagination" style="    margin:0.5rem 1rem;">
                            <li class="page-item disabled">
                              <span class="page-link">Previous</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active" aria-current="page">
                              <span class="page-link">2</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
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

                Object.keys(options.collumns).forEach( colrow => {
                    if ( data[0][options.collumns[colrow].key] !== undefined ) {

                        let title = options.collumns[colrow].key;
                        let cssStyle = "";

                        if ( options.collumns[colrow].title !== undefined ) {
                            title = options.collumns[colrow].title;
                        }

                        if ( options.collumns[colrow].cssStyle !== undefined && options.collumns[colrow].cssStyle.head !== undefined ) {
                            cssStyle = options.collumns[colrow].cssStyle.head;
                        }

                        let sort_icon = "bi bi-sort-up";
                        let sort_data = `data-sort="${title}"`;

                        if ( filter.orderBy == `ORDER BY ${title} DESC` ) {
                            sort_icon = "bi bi-sort-down";
                            sort_data = `data-sort="${title}"`;
                        }

                        if ( filter.orderBy == `ORDER BY ${title} ASC` ) {
                            sort_icon = "bi bi-sort-up";
                            sort_data = `data-sort="${title}"`;
                        }

                        if ( title == "" ) {
                            sort_icon = "";
                            sort_data = "";
                        }

                        cell = cell + `
                        <td style="height:3rem;${cssStyle}">
                            <i class="${sort_icon}" ${sort_data}></i>
                            <span>${title}</span>
                        </td>`;
                    }
                });

                template = template + `<tr class="c_0"  style="line-height:1.5rem;height:3rem;">${cell}</tr>` ;

                for (let i = 0; i < data.length; i++ ) {
                    let cell = "";
                    let cssStyle = "";

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
