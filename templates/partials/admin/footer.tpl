</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script src="/javascript/ql_form.js"></script>
<script src="/javascript/ql_input.js"></script>
<script src="/javascript/ql_checkbox.js"></script>
<script src="/javascript/ql_button.js"></script>

<?php if ( App\Security\Access::PUBLIC !== App\Security\Authorization::getAccess() ) { ?>

<?php include __DIR__ . "/../../modals/modal-inserted.tpl"; ?>
<?php include __DIR__ . "/../../modals/modal-alert.tpl"; ?>

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