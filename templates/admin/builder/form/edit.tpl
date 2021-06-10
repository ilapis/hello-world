<link rel="stylesheet" href="/css/builder/form.css" />

<div id="breadcrumb">
    <span style="width: calc(300px - 1rem);float:left;display: block;">Admin | Builder | Form | Update</span>
    <span style="width: calc(100% - 300px - 1rem - 3rem);float:left;display: block;">
            <form id="builder_form" class="row g-3 needs-validation" novalidate action="/admin/builder/form/update/<?=$model['data']['id']?>" data-method="post">
                <input type="hidden" id="builder_form_id" name="id" required data-value value="<?=$model['data']['id']?>" />
                <input type="text" id="builder_form_title" name="title" class="form-control" placeholder="Formos pavadinimas" required data-value value="<?=$model['data']['title']?>" />
                <input type="hidden" id="builder_form_settings" name="settings" class="form-control" placeholder="Formos pavadinimas" value='<?=strtr($model['data']['settings'], ["\\'" => "'"])?>' data-value />
                <input id="builder_form_submit" type="submit" class="d-none" />
            </form>
        </span>
    <span style="float:right;display: block;text-indent:0rem;right: 0.875rem;position: relative;margin-top: 0.875rem;" class="btn btn-primary" data-action="builder-form-save"><i class="bi bi-save"></i></span>
</div>

<div id="builder">

    <div id="over_draggable">
        <input type="text" class="form-control" placeholder="Ieškoti" />
    </div>
    <div id="over_sortable">
        <div class="btn btn-default" data-action="builder-form-preview"><i class="bi bi-eye"></i></div>
    </div>

    <ul id="draggable">
        <li class="draggable ui-state-highlight" data-index="1" data-hide="false" data-single="true" data-input="input-username" data-settings='<?=json_encode(App\Input\TextInput::username())?>' >Username</li>
        <li class="draggable ui-state-highlight" data-index="2" data-hide="false" data-single="true" data-input="input-password" data-settings='<?=json_encode(App\Input\TextInput::password())?>' >Password</li>
        <li class="draggable ui-state-highlight" data-index="3" data-hide="false" data-single="true" data-input="input-title" data-settings='<?=json_encode(App\Input\TextInput::title())?>' >Title</li>
        <li class="draggable ui-state-highlight" data-index="4" data-hide="false" data-single="true" data-input="input-email" data-settings='<?=json_encode(App\Input\TextInput::email())?>' >Email</li>
    </ul>

    <ul id="sortable" class="connectedSortable" >
    </ul>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        builderFormInitEditForm();

        $( function() {
            $( "#sortable" ).sortable({
                revert: true,
                placeholder: "ui-state-highlight"
            });
            $( ".draggable" ).draggable({
                connectToSortable: "#sortable",
                helper: "clone",
                revert: "invalid"
            });
            $( "#sortable" ).sortable({
                connectWith: ".connectedSortable",
                stop: function() {
                    builderFormInit();
                }
            }).disableSelection();
        });
    });
</script>