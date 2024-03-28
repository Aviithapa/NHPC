<link href="{{asset('jquery-file-upload/css/jquery.fileupload-ui.min.css')}}" rel="stylesheet" type="text/css"/>
<script src="{{asset('jquery-file-upload/js/vendor/jquery.ui.widget.js')}}" type="text/javascript"></script>
<script src="{{asset('jquery-file-upload/js/jquery.iframe-transport.js')}}" type="text/javascript"></script>
<script src="{{asset('jquery-file-upload/js/jquery.fileupload.js')}}" type="text/javascript"></script>
<script>
    $('.dropify').dropify();

    function anyFileUploader(id){
       var baseUrl = window.location.protocol + '//' + window.location.host;
           // Construct the full URL for the AJAX request
        var searchUrl = baseUrl + '/student/dashboard/save_image';
        $('input[name$="'+id+'_image"]').fileupload({

            url: searchUrl + '/' + id,
            done: function(e, data) {
                console.log(data);
                $('#'+id+'_path').val(data.result.image_name);
            },
            error: function(e,data){
                console.log(e);
            },

        });
    }

</script>
