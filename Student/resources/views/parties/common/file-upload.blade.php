<link href="{{asset('jquery-file-upload/css/jquery.fileupload-ui.min.css')}}" rel="stylesheet" type="text/css"/>
<script src="{{asset('jquery-file-upload/js/vendor/jquery.ui.widget.js')}}" type="text/javascript"></script>
<script src="{{asset('jquery-file-upload/js/jquery.iframe-transport.js')}}" type="text/javascript"></script>
<script src="{{asset('jquery-file-upload/js/jquery.fileupload.js')}}" type="text/javascript"></script>
<script>
    $('.dropify').dropify();

    function anyFileUploader(id){

        $('input[name$="'+id+'_image"]').fileupload({

            url: '{{ url('student/dashboard/save_image') }}' + '/' + id,
            done: function(e, data) {
                $('#'+id+'_img').attr('src', data.result.full_url);
                $('#'+id+'_path').val(data.result.image_name);
                $('#'+ id +'_progress').parent().removeClass('progress-striped');
                $('#'+id+'_help_text').text('Image Upload Successfully');
            },
            error: function(e,data){
                $('#'+id+'_help_text').text(eval('e.responseJSON.'+id+'_image')[0]);
                $('#'+ id +'_progress').css('width','0%');
                console.log(e.responseText);
            },
            progress: function(e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#'+ id +'_progress').css('width', progress + '%');
            }

        });
    }

</script>
