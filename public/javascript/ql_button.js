(function( $ ) {

    $.fn.ql_button = function( options ) {

        return this.each( function (index, data)  {

            if ( options.template !== undefined ) {
                $(data).html(options.template);
            }

            if ( options.linkFrom !== undefined && options.linkTo !== undefined ) {

                $(document).on("click", options.linkTo, function () {
                    $(options.linkFrom).trigger("click");
                });
            }
        } );
    };

}( jQuery ));
