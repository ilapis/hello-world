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

            let autocomplete = "";
            if ( options.input.autocomplete !== undefined) { autocomplete = "autocomplete='" + options.input.autocomplete + "'";}

            let value = "";
            if ( options.input.value !== undefined) { value = "value='" + options.input.value + "'";}

            let label = "";
            if ( options.label !== undefined && options.label.text !== undefined ) { label = options.label.text;}

            let hidden = "height:3rem";
            if ( options.input !== undefined && options.input.type == "hidden" ) {
                hidden = "display:none;";
            }

            let feedback = "";
            if ( options.messages !== undefined &&  options.messages.valid_feedback !== undefined && options.messages.invalid_feedback !== undefined ) {
                feedback = `
                <div className="valid-feedback">${options.messages.valid_feedback}</div>
                <div className="invalid-feedback">${options.messages.invalid_feedback}</div>
                `;
            }

            return `
            <div class="form-group row mb-3" style='${hidden}'>
                <label for="${options.input.id}" class="col-sm-4 form-label">${label}</label>
                <div class="col-sm-8">
                <input type="${options.input.type}" class="form-control" id="${options.input.id}" name="${options.input.name}" ${autocomplete} ${value} required data-value >
                ${feedback}
                </div>
            </div>
            `;
        }

        function _get_template( options ) {

            let autocomplete = "";
            if ( options.input.autocomplete !== undefined) { autocomplete = "autocomplete='" + options.input.autocomplete + "'";}

            let value = "";
            if ( options.input.value !== undefined) { autocomplete = "value='" + options.input.value + "'";}

            let label = "";
            if ( options.label !== undefined && options.label.text !== undefined ) { label = options.label.text;}

            let hidden = "height:3rem";
            if ( options.input !== undefined && options.input.type == "hidden" ) {
                hidden = "display:none;";
            }

            let feedback = "";
            if ( options.messages !== undefined &&  options.messages.valid_feedback !== undefined && options.messages.invalid_feedback !== undefined ) {
                feedback = `
                <div className="valid-feedback">${options.messages.valid_feedback}</div>
                <div className="invalid-feedback">${options.messages.invalid_feedback}</div>
                `;
            }

            return `
            <div class="mb-3" style='${hidden}'>
                <label for="${options.input.name}" class="form-label">${label}</label>
                <input type="${options.input.type}" class="form-control" id="${options.input.id}" name="${options.input.name}" ${autocomplete} ${value} required data-value>
                ${feedback}
            </div>
            `;
        }

    };

}( jQuery ));
