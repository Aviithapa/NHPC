<link href="{{asset('jquery-file-upload/css/jquery.fileupload-ui.min.css')}}" rel="stylesheet" type="text/css"/>
<script src="{{asset('jquery-file-upload/js/vendor/jquery.ui.widget.js')}}" type="text/javascript"></script>
<script src="{{asset('jquery-file-upload/js/jquery.iframe-transport.js')}}" type="text/javascript"></script>
<script src="{{asset('jquery-file-upload/js/jquery.fileupload.js')}}" type="text/javascript"></script>
<script>
    $('.dropify').dropify();

    function anyFileUploader(id){
        console.log(id);

        $('input[name$="'+id+'_image"]').fileupload({

            url: '{{ url('student/dashboard/save_image') }}' + '/' + id,
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
