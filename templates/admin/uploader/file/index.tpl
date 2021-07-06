<div id="breadcrumb">
    <span style="width: calc(300px - 1rem);float:left;display: block;">Admin | Uploader | File</span>

    <div style="float:right;right: 0.875rem;position: relative;">
        <input type="file" name="file[]" id="imageListFile" class="btn btn-primary" style="display:none;">
        <span class="input-group-btn" >
                <button class="browse btn btn-primary" type="button" ><i class="bi bi-upload"></i> Įkelti failą</button>
            </span>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    (function($) {

        $.fn.qUpload = function(settings) {

            var posturl = settings["uploadurl"];
            var filebuttonhidden = settings["filebuttonhidden"];
            var filebutton = settings["filebutton"];
            var imagefolder = settings["imagefolder"];

            $(document).on('click', filebutton, function () {
                $(filebuttonhidden).trigger('click');
            });

            $(document).on('change', filebuttonhidden, function () {

                var files = $(filebuttonhidden)[0].files;
                var folder = $(imagefolder).attr("data-folder");
                var i = 0, len = files.length;

                (function readFile(n) {
                    var reader = new FileReader();
                    var f = files[n];
                    reader.onload = function (e) {

                        var sReplacer = '{"folder": "' + folder + '", "file": "#FILENAME#","base64": "#BASE64#"}';
                        var rString = randomString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
                        enhanceFormWithUploadProgress({sProgressID: rString, folder: folder, file: f.name}, sReplacer.replace("#FILENAME#", f.name).replace("#BASE64#", e.target.result));

                        if (n < len - 1)
                            readFile(++n)
                    };
                    reader.readAsDataURL(f);
                }(i));

            });

            function enhanceFormWithUploadProgress(sProgress, data) {

                var xhr = new XMLHttpRequest();
                if (!(xhr && ('upload' in xhr) && ('onprogress' in xhr.upload)) || !window.FormData) {
                    return;
                }

                xhr.upload.addEventListener('loadstart', function (event) {
                    console.log("Start upload: " + sProgress['sProgressID']);
                    //$("#imageList").prepend("<div id='" + sProgress['sProgressID'] + "' class='imageHolder'><img class='img-thumbnail img-fluid' src='https://via.placeholder.com/200x200' data-selected-image data-selected='false'  /><div class='progress'><div class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'>0%</div></div><div>" + sProgress['file'] + "</div></div>");
                    $("#imageList").prepend("<div id='" + sProgress['sProgressID'] + "' class='imageHolder'><div class='progress'><div class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'>0%</div></div><div>" + sProgress['file'] + "</div></div>");
                }, false);

                xhr.upload.addEventListener('progress', function (event) {
                    var percent = (100 * event.loaded / event.total).toFixed(2);
                    console.log('Upload progress: ' + percent + '%');
                    $("#" + sProgress['sProgressID']).find(".progress").html("<div class='progress-bar' role='progressbar' aria-valuenow='" + percent + "' aria-valuemin='0' aria-valuemax='100' style='width:" + percent + "%'>" + percent + "%</div>");
                }, false);

                xhr.upload.addEventListener('load', function (event) {
                    console.log('Upload completed, waiting for response...');
                }, false);

                xhr.addEventListener('readystatechange', function (event) {
                    if (event.target.readyState == 4 && event.target.responseText) {
                        console.log(event.target.responseText);
                        var data = JSON.parse(event.target.responseText);
                        //var data = event.target.responseText;
                        console.log(data);
                        /*
                        for (var file in data.list) {
                            if (data.list[file] != "..") {
                                $("#" + sProgress['sProgressID']).find(".progress").remove();
                                $("#" + sProgress['sProgressID']).find("[src]").attr('src', sProgress['folder'] + "/" + sProgress['file']);
                            }
                        }
                        */

                    } else {
                        //console.log(event);
                    }
                }, false);
                xhr.open("POST", posturl);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

                try {
                    JSON.parse(JSON.stringify(data));
                } catch (e) {
                    console.log("non-validJson");
                }

                xhr.send(data);

            }

            function randomString(length, chars) {
                var result = '';
                for (var i = length; i > 0; --i)
                    result += chars[Math.floor(Math.random() * chars.length)];
                return result;
            }

        };

    }(jQuery));

}, false);
</script>

<div id="imageListToolbar"></div>
<div id="imageList" style="height:calc(100% - 3rem - 3rem);overflow: auto;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $(document).qUpload({
            uploadurl: "/admin/uploader/file/save",
            filebuttonhidden: "#imageListFile",
            filebutton: ".browse",
            imagefolder: "#imageListToolbar"
        });
    }, false);
</script>