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



{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        // Basic--}}
{{--        $('.dropify').dropify();--}}

{{--        $(function () {--}}
{{--            $(document).on("click", "#saveImage", function (event) {--}}
{{--                let myForm = document.getElementById('saveForm');--}}
{{--                console.log("You are here");--}}
{{--                let formData = new FormData(myForm);--}}
{{--                console.log(formData);--}}
{{--                console.log(formData);--}}
{{--            });--}}
{{--            function uploadImage(formData) {--}}
{{--                $.ajaxSetup({--}}
{{--                    headers: {--}}
{{--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                    }--}}
{{--                });--}}
{{--                $.ajax({--}}
{{--                    type: "POST",--}}
{{--                    data: formData,--}}
{{--                    dataType: 'JSON',--}}
{{--                    contentType: false,--}}
{{--                    processData: false,--}}
{{--                    url: "{{ route('save_image') }}",--}}
{{--                    success: function (data) {--}}
{{--                        if (data.status) {--}}
{{--                            console.log(data.message);--}}
{{--                        } else {--}}
{{--                            console.log(data.error)--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: function (err) {--}}
{{--                        console.log('Something went Wrong!')--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}






{{--        var drDestroy = $('#input-file-to-destroy').dropify();--}}
{{--        drDestroy = drDestroy.data('dropify')--}}
{{--        $('#toggleDropify').on('click', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            if (drDestroy.isDropified()) {--}}
{{--                drDestroy.destroy();--}}
{{--            } else {--}}
{{--                drDestroy.init();--}}
{{--            }--}}
{{--        })--}}
{{--    });--}}


{{--</script>--}}

<script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js" type="text/javascript"></script>

