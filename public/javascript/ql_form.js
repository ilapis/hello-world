(function( $ ) {

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation');

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if ( !form.checkValidity() ) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                    let data = [];
                    $(this).find('[data-value]').each( function () {
                        data[$(this).attr('name')] = $(this).val();
                    } );
                    console.log(data);
                }
                form.classList.add('was-validated')
            }, false)
        })

    $.fn.ql_form = function( inputs ) {

        let element = this;

        return this.each( function (index, data)  {
            $.each( inputs, function (index2, data2) {
                $(element).append(`
                    <div id="index_${index2}">${index2}</div>
                `);
                if ( data2.script  === 'ql_input' ) {
                    $(`#index_${index2}`).ql_input(data2);
                }
                if ( data2.script  === 'ql_button' ) {
                    $(`#index_${index2}`).ql_button(data2);
                }
            });
        });
    };

}( jQuery ));