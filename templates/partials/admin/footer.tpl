</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/javascript/ql_form.js"></script>
<script src="/javascript/ql_input.js"></script>
<script src="/javascript/ql_checkbox.js"></script>
<script src="/javascript/ql_button.js"></script>
<script src="/javascript/ql_builder_form.js"></script>

<script>

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

    function responseHandler(response) {

        if ( response.action == "redirect" ) {
            window.location.replace(response.redirect);
        }

        if ( response.action == "modal" || response.action == "modal-redirect" ) {

            let myModal = new bootstrap.Modal(document.getElementById(response.modal), {
                keyboard: false
            })

            document.getElementById(response.modal).addEventListener('shown.bs.modal', function () {

                if ( response.timeout != undefined ) {
                    setTimeout(function () {

                        if ( response.action == "modal-redirect" ) {
                            window.location.replace(response.redirect);
                        }

                        myModal.hide();

                    }, response.timeout);
                }
            })

            $("#" + response.modal).find(".modal-header").html(response.title);
            $("#" + response.modal).find(".modal-body").html(response.message);

            myModal.show();
        }
    }
</script>

<?php if ( App\Security\Access::PUBLIC !== App\Security\Authorization::getAccess() ) { ?>

<?php include __DIR__ . "/../../modals/modal-inserted.tpl"; ?>
<?php include __DIR__ . "/../../modals/modal-alert.tpl"; ?>
<?php include __DIR__ . "/../../modals/modal-confirm.tpl"; ?>
<?php include __DIR__ . "/../../modals/modal-success.tpl"; ?>

<script src="/javascript/sticky-table.min.js"></script>
<script src="/javascript/ql_table.js"></script>

<script>
    let sidebar_selection = window.location.pathname;
    if ( sidebar_selection.indexOf("/create") > 0 ) {
        $("a[href='" + window.location.pathname.split('/create')[0] + "']").parent().addClass("selected");
    } else if ( sidebar_selection.indexOf("/edit/") > 0 ) {
        $("a[href='" + window.location.pathname.split('/edit/')[0] + "']").parent().addClass("selected");
    } else {
        $("a[href='" + window.location.pathname + "']").parent().addClass("selected");
    }

    var modal_confirm = new bootstrap.Modal(document.getElementById("modal-confirm"), {
        keyboard: false
    })

    $(document).on("click", "[data-popup]", function() {

        let settings = $(this).data("popup");

        if ( settings.type == "modal-confirm" ) {
            $("#modal-confirm").find(".modal-body").html(settings.message);
            $("#modal-confirm-button").data("settings", settings);
            modal_confirm.show();
        }
    });

</script>

<?php } ?>

</body>
</html>