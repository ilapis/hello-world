(function( $ ) {

    $.fn.ql_checkbox = function( options ) {

        return this.each( function (index, data)  {
            $(data).html(_get_template(options));
        } );

        function _get_template( options ) {

            let value = "";
            if ( options.input.value !== undefined) { value = "value='" + options.input.value + "'";}

            let label = "";
            if ( options.label !== undefined && options.label.text !== undefined ) { label = options.label.text;}

            let required = "";
            if ( options.validator !== undefined && options.validator.required === true ) { required = "required";}

            let checked = "";
            if ( options.checked == "1" || options.checked == "true" ) { checked = "checked='checked'";}

            let feedback = "";
            if ( options.messages !== undefined &&  options.messages.valid_feedback !== undefined && options.messages.invalid_feedback !== undefined ) {
                feedback = `
                <div className="valid-feedback">${options.messages.valid_feedback}</div>
                <div className="invalid-feedback">${options.messages.invalid_feedback}</div>
                ;`
            }

            return `
            <div class="row mb-3" style='height:5rem;'>
                <div class="col-sm-4 form-label">&nbsp;</div>
                <div class="col-sm-8">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="${options.input.name}"  name="${options.input.name}" ${required} ${checked} data-value style="margin-top: 0.75rem;" >
                      <label class="form-check-label" for="${options.input.name}">${label}</label>
                      ${feedback}
                  </div>
                </div>
            </div>
            `;
        }

    };

}( jQuery ));
