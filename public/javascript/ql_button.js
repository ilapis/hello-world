(function( $ ) {

    $.fn.ql_button = function( options ) {

        return this.each( function (index, data)  {
            if ( options.template !== undefined ) {
                $(data).html(options.template);
            }
        } );
    };

}( jQuery ));
