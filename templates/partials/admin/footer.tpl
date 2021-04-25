</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script src="/javascript/ql_form.js"></script>
<script src="/javascript/ql_input.js"></script>
<script src="/javascript/ql_checkbox.js"></script>
<script src="/javascript/ql_button.js"></script>

<?php if ( App\Security\Access::PUBLIC !== App\Security\Authorization::getAccess() ) { ?>

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
</script>

<?php } ?>

</body>
</html>