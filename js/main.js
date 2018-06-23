var map;
function initMap() {

    var myLatLng = {lat: parseFloat(options.latitude)  , lng: parseFloat(options.longitude) };

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: parseInt(options.zoom),
        center: myLatLng
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'La Pizzeria'
    });


}


$ = jQuery.noConflict();

$(document).ready(function() {

    // Menu Button
  $('.mobile-menu a').on('click', function() {
    $('nav.site-nav').toggle('slow');
  });



    //Show mobile menu
    var breakpoint = 768;
    $(window).resize(function(){

        boxAdjustments();
        if($(document).width() >= breakpoint) {
            $('nav.site-nav').show();
        } else {
            $('nav.site-nav').hide();
        }
    });



    //Adapting the height of images to div elements

    boxAdjustments();

    //FluidBox PLugin

    jQuery('.gallery a').each(function() {
        jQuery(this).attr({'data-fluidbox': ''});
    });

    if(jQuery('[data-fluidbox]').length > 0) {
        jQuery('[data-fluidbox]').fluidbox();
    }

    //Adapt map to Height of Container

    var map = $('#map');
    if(map.length > 0) {
        if($(document).width() >= 768) {
            displayMap(0);
        }

        else {
            displayMap(300);
        }
    }

    $(window).resize(function () {
        if($(document).width() >= 768) {
            displayMap(0);
        }

        else {
            displayMap(300);
        }
    });



});

function boxAdjustments() {

    var images = $('.box-image');

    if (images.length > 0) {

        var imageHeight = images[0].height;
        var boxes = $('.content-box');
        $(boxes).each(function(i,element) {
            $(element).css({'height': imageHeight + 'px'});
        });

    }
}

function displayMap(value) {
    if(value == 0 ) {
        var locationSection = $('.location-reservation');
        var locationHeight = locationSection.height();
        $('#map').css({'height': locationHeight});
    } else {
        $('#map').css({'height': value});
    }
}
