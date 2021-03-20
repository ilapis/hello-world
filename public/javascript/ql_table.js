(function( $ ) {

    $.fn.ql_table = function( options ) {

        return this.each( function (index, data)  {
            $(data)
                .html(`
                    ${_get_buttons()}
                    ${_get_table(options)}
                    ${_get_pagination_row()}
                `)
                .css({"height": options.height + 'px'})
            ;

            $(`#${options.id}`).sticky({
                "top": "tbody tr:first-child",/*,
                "bottom" : "tbody tr:last-child"
                left:"",
                right:""*/
            });

           $(data).find(".wrapper-sticky").each( function() {
               $(this).height( options.height - 2 - 3 * 16 - 6 * 16 - 8 );
           });

        } );

        function _get_buttons() {

            return `
                <div style="height:6rem;width:100%;">
                                        <button class="btn btn-primary" style="    margin: 2.5rem 1.25rem 0 0.5rem;
                    height: 3.5rem;
                    width: 3.5rem;
                    border-radius: 3rem;
                    margin-top: -1.75rem;
                    position: absolute;
                    right: 0;"><i class="fs-2 bi bi-plus" style="line-height: 2rem;display: block;"></i></button>
                                        <button class="btn btn-default" style="border: 1px solid #CCCCCC;
                    float: left;
                    margin: 2.5rem 0rem 1rem 1rem;">Export</button>
                </div>
            `;
        }

        function _get_table( options ) {

            return `
            <table id="${options.id}">
                ${_get_body_rows()}
            </table>
            `;
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

        function _get_body_rows() {

            let template = "";

            for (let i = 0; i < 100; i++ ) {
                if( i === 0) {
                    template = template + `
                <tr class="c_${i}" style="line-height:1.5rem;">
                    <td>sd <i class="bi bi-sort-down" style="float:right;font-size: 1.5rem;"></i> </td>
                    <td>sd <i class="bi bi-sort-up-alt" style="float:right;font-size: 1.5rem;"></i> </td>
                    <td>hj</td>
                </tr>`
                    ;
                } else {
                    template = template + `
                <tr class="c_${i}">
                    <td>sd</td>
                    <td>fg</td>
                    <td>hj</td>
                </tr>`
                    ;
                }
            }
            return template;
        }
    };

}( jQuery ));
