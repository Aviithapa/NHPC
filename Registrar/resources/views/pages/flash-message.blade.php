@if ($message = Session::get('success'))
    <div class="modal in"  role="dialog" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                </div>

                <div class="modal-body">

                    <div class="thank-you-pop">
                        <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
                        <h1>Thank You!</h1>
                        <p>{{$message}}</p>
                        <button onclick="$('.modal').css('display','none')" class="btn btn-primary  mt-2"><i class="fa fa-check"></i>
                            Ok</button>

                </div>

            </div>
        </div>
    </div>
    </div>
@endif

@if ($message = Session::get('already'))
    <div class="modal in"  role="dialog" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" onclick="$('.modal').css('display','none')" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                </div>

                <div class="modal-body">

                    <div class="thank-you-pop">
                        <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
                        <h1>{{$message}}</h1>
                        <button onclick="$('.modal').css('display','none')" class="btn btn-primary  mt-2"><i class="fa fa-check"></i>
                            Ok</button>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('error'))
<div class="modal in"  role="dialog" style="display: block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="$('.modal').css('display','none')" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
            </div>

            <div class="modal-body">

                <div class="thank-you-pop">
                    {{-- <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt=""> --}}
                    <h1>{{$message}}</h1>
                    <button onclick="$('.modal').css('display','none')" class="btn btn-primary  mt-2"><i class="fa fa-check"></i>
                        Ok</button>


                </div>

            </div>
        </div>
    </div>
</div>
@endif


@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Please check the form below for errors
    </div>
@endif

<script>
    function close() {
        alert("You are here");
        var modal = document.getElementById("messageModal");
        modal.style.display = "none";
    }
</script>

