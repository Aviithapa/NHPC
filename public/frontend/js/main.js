$('#owl1').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    autoplay: true,
    responsive: {
        0: {
            items: 1
        }
    }
});

$('#owl3').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    autoplayHoverPause:false,
    autoplay: true,
    responsive: {
        0: {
            items: 1
        }
    }
});



$('#owl2').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    autoplayHoverPause:true,
    autoplay: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 3
        }
    }
});

$(window).scroll(function () {
    var scroll=$(window).scrollTop();
if(scroll >= 50) {
$("header").addClass("sticky");
} else {
$("header").removeClass("sticky");
}
});

new WOW().init();


//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    // document.body.scrollTop = 0;
    // document.documentElement.scrollTop = 0;
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
}
