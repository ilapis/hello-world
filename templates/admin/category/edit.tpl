<span id="default_save" class="btn btn-primary" style="
                        margin: 2.5rem 1.25rem 0 0.5rem;
                        height: 3.5rem;
                        width: 3.5rem;
                        border-radius: 3rem;
                        margin-top: -1.75rem;
                        position: absolute;
                        right: 0;"><i class="fs-2 bi bi-plus" style="line-height: 2.5rem;display: block;right: 1px;position: relative;"></i>
</span>

<div class="col-md-6">
    <form id="inputs" class="row g-3 needs-validation" novalidate action="/admin/category/update/<?=$model['data']['id']?>" data-method="post"></form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $("#inputs").ql_form(<?=json_encode(App\Form\Admin\CategoryPageForm::get($model["data"]));?>);
    }, false);
</script>
