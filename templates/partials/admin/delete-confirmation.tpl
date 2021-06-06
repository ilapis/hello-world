<div class="d-flex justify-content-center">
    <form id="inputs" class="row g-3 needs-validation col-sm-12" novalidate  data-method="delete"></form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $("#inputs").ql_form(<?=json_encode(App\Form\DefaultPageForm::delete($model));?>);
    }, false);
</script>