<?php
include 'includes/header.php';
include 'includes/sessionCheck.php';
?>
<div class="well">
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Ajouter des fichiers</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Commencer l'envoi</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Arrêter l'envoi</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Supprimer</span>
                </button>
                <!-- The loading indicator is shown during file processing -->
                <span class="fileupload-loading"></span>
            </div>
            <!-- The global progress information -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped">
            <tbody class="files"></tbody>
        </table>
    </form>
    <br>
    <div class="alert alert-info">
        <ul>
            <li>Vous pouvez utiliser le "Drag & Drop" directement sur la page pour ajouter des fichiers à upload.</li>
        </ul>
    </div>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="col-lg-1">
            <span class="preview"></span>
        </td>
        <td class="col-lg-3" style="vertical-align: middle">
            <p class="name">{%=file.name%}</p>
            {% if (file.error) { %}
            <div><span class="label label-important">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td class="col-lg-5">
            <p class="size">{%=o.formatFileSize(file.size)%}</p>
            {% if (!o.files.error) { %}
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
            {% } %}
        </td>
        <td class="col-lg-3" style="vertical-align: middle">
            {% if (!o.files.error && !i && !o.options.autoUpload) { %}
            <button class="btn btn-primary start">
                <i class="glyphicon glyphicon-upload"></i>
                <span>Commenrcer</span>
            </button>
            {% } %}
            {% if (!i) { %}
            <button class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span>Annuler</span>
            </button>
            {% } %}
        </td>
    </tr>
    {% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview"></span>
        </td>
        <td style="vertical-align: middle">
            <p class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
            </p>
            {% if (file.error) { %}
            <div><span class="label label-important">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td style="vertical-align: middle">
            <a class="btn btn-success" disabled="disabled">Termnié</a>
        </td>
    </tr>
    {% } %}
</script>
<script src="/assets/js/jquery.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="/assets/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="/assets/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="/assets/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="/assets/js/canvas-to-blob.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="/assets/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/assets/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="/assets/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="/assets/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="/assets/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="/assets/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="/assets/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="/assets/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="/assets/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="/assets/js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
<hr>
<!-- FOOTER -->
<footer>
    <p><?php echo $appName . ' ' . $version; ?> &copy; 2013 &middot; <a href="#">Privacy</a> &middot; <a
            href="#">Terms</a></p>
</footer>
</div><!-- /.container -->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>