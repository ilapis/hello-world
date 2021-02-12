(function( $ ) {

    $.fn.ql_input = function( options ) {

        return this.each( function (index, data)  {
            if ( options.inline !== undefined && options.inline ) {
                $(data).html(_get_template_inline(options));
            } else {
                $(data).html(_get_template(options));
            }
        } );

        function _get_template_inline( options ) {
            return `
            <div class="form-group row mb-3" style='height:3rem;'>
                <label for="${options.input.id}" class="col-sm-4 form-label">${options.label.text}</label>
                <div class="col-sm-8">
                <input type="${options.input.type}" class="form-control" id="${options.input.id}" name="${options.input.name}" required data-value>
                <div class="valid-feedback">${options.messages.valid_feedback}</div>
                <div class="invalid-feedback">${options.messages.invalid_feedback}</div>
                </div>
            </div>
            `;
        }

        function _get_template( options ) {
            return `
            <div class="mb-3" style='height:5rem;'>
                <label for="${options.input.name}" class="form-label">${options.label.text}</label>
                <input type="${options.input.type}" class="form-control" id="${options.input.id}" name="${options.input.name}" required data-value>
                <div class="valid-feedback">${options.messages.valid_feedback}</div>
                <div class="invalid-feedback">${options.messages.invalid_feedback}</div>
            </div>
            `;
        }

    };

}( jQuery ));
