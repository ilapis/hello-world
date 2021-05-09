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
                    let data = {};
                    $(this).find('[data-value]').each( function () {

                        if ( $(this).is(':checkbox')) {
                            if ( $(this).is(':checked')) {
                                data[$(this).attr('name')] = "1";
                            } else {
                                data[$(this).attr('name')] = "0";
                            }
                        } else {
                            data[$(this).attr('name')] = $(this).val();
                        }

                    } );

                    postData( form.action, form.getAttribute("data-method"), data ).then(response => {
                        if ( response.action == "redirect" ) {
                            window.location.replace(response.redirect);
                        }

                    });

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
                if ( data2.script  === 'ql_checkbox' ) {
                    $(`#index_${index2}`).ql_checkbox(data2);
                }
            });
        });
    };

    async function postData(url = '', method = 'POST', data = {}) {
        const response = await fetch(url, {
            method: method,
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json'
            },
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: JSON.stringify(data)
        });

        return response.json();
    }

}( jQuery ));
