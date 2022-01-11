<!-- jQuery 3 -->
<script src="{{asset('dist/js/jquery.min.js')}}"></script>

<!-- v4.0.0-alpha.6 -->
<script src="{{asset('dist/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- template -->
<script src="{{asset('dist/js/adminkit.js')}}"></script>

<!-- Morris JavaScript -->
<script src="{{asset('dist/plugins/raphael/raphael-min.js')}}"></script>
<script src="{{asset('dist/plugins/morris/morris.js')}}"></script>
<script src="{{asset('dist/plugins/functions/dashboard1.js')}}"></script>

<!-- Chart Peity JavaScript -->
<script src="{{asset('dist/plugins/peity/jquery.peity.min.js')}}"></script>
<script src="{{asset('dist/plugins/functions/jquery.peity.init.js')}}"></script>

<!-- dropify -->
<script src="{{asset('dist/plugins/dropify/dropify.min.js')}}"></script>
<script>
    $(document).ready(function () {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function (event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function (event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function (event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function (e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });


</script>
