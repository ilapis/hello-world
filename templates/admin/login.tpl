<div class="container">
    <div class="row justify-content-md-center" style="top: calc(25%);position: relative;">
        <div class="col-md-6">
            <form id="inputs" class="row g-3 needs-validation" novalidate action="/admin/login" method="post"></form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        $("#inputs").ql_form({
            "username": {
                script: "ql_input",
                inline: true,
                    label: {
                    text: '* Username'
                },
                input: {
                    id: 'username',
                    name: 'username',
                    type: 'text'
                },
                validator: {
                    required: true
                },
                messages: {
                    valid_feedback: '',
                        invalid_feedback: 'Required'
                }
            },
            "password": {
                script: "ql_input",
                inline: true,
                label: {
                    text: '* Password'
                },
                input: {
                    id: 'password',
                    name: 'password',
                    type: 'password'
                },
                validator: {
                    required: true
                },
                messages: {
                    valid_feedback: '',
                    invalid_feedback: 'Required'
                }
            },
            "submit": {
                script: "ql_button",
                template: `<button type="submit" class="btn btn-primary float-end" >Submit</button>`
            }
        });

    }, false);
</script>

<style>
    html, body {
        height: 100%;
        width: 100%;
    }
    .container {
        height: 100%;
    }
    label {
        line-height: 2.375rem;
    }
    form {
        padding: 1rem 1rem 1.5rem 1rem;
        border: 1px solid #CCCCCC;
        border-radius: 0.25rem;
    }
</style>