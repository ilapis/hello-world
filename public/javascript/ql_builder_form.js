var builder_form_template = '<div class="builder_form_template"><div id="pid_${input}" class="left"></div><div class="right"><div data-action="builder-form-data-remove" data-remove="${index}" class="btn btn-danger"><i class="bi bi-trash"></i></div></div></div>';

function builderFormInit() {
    $("#sortable li").each( function () {
        $(this)
            .removeClass("draggable")
            .removeClass("ui-state-highlight")
            .removeClass("ui-draggable")
            .removeClass("ui-draggable-handle")
            .addClass("ui-state-default")
            .addClass("ui-sortable-handle")
            .css({"width": $("#sortable").width() + "px", "height": "auto", "padding": "0 1rem"})
        ;

        let index = $(this).data("index");
        let input = $(this).data("input");

        if ( $(this).data("single") ) {
            $("#draggable").find("[data-index='" + $(this).data("index") + "']").attr("data-hide", "true");
        }

        let template = builder_form_template.replaceAll("${index}", index).replaceAll("${input}", input);
        $(this).html(template);
        if ( $(this).data("settings") != undefined) {
            $("#pid_" + $(this).data("input")).ql_input($(this).data("settings"));
        }
    });
}

function builderFormInitEditForm() {

    let settings = JSON.parse($("#builder_form_settings").val());

    $(settings).each( function (index, data) {
        let settings = JSON.stringify(data.settings);
        let data_index = $(`#draggable [data-input='${data.input}']`).data("index");
        $("#sortable").append(`
            <li class="ui-state-default ui-sortable-handle" data-index='${data_index}' data-settings='${settings}' data-input="${data.input}" data-single="${data.single}"></li>
        `);
    });

    $("#sortable li").each( function () {

        let index = $("#draggable [data-input='"+$(this).data("input")+"']").data("index");
        let input = $(this).data("input");
        let settings = $(this).data("settings");

        if ( $(this).data("single") ) {
            $("#draggable").find(`[data-index='${index}']`).attr("data-hide", "true");
        }

        let template = builder_form_template.replaceAll("${index}", index).replaceAll("${input}", input);
        $(this).html(template);
        if ( $(this).data("settings") != undefined) {
            $(`#pid_${input}`).ql_input(settings);
        }
    });

}

$(document).on('click', '[data-action]', function () {

    if ( "builder-form-save" == $(this).data("action") ) {
        let settings = [];
        $("#sortable").find("li").each( function (index, data) {
            settings[index] = {settings: [], input: "", single: ""};
            settings[index]['settings'] = $(this).data("settings");
            settings[index]['input'] = $(this).data("input");
            settings[index]['single'] = $(this).data("single");
        });
        $("#builder_form_settings").val(JSON.stringify(settings));
        $("#builder_form_submit").trigger("click");
    }

    if ( "builder-form-data-remove" == $(this).data("action") ) {
        let index = $(this).data("remove");
        $(this).closest("li").remove();
        $(`#draggable [data-index="${index}"]`).attr("data-hide", "false");
    }

});
