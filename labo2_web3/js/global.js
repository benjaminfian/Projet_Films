function accueil()
{
    $('#contenu').html("")
    var rep = '<div class="row mt-5 justify-content-center">\
                    <div class="card img_accueil mx-2 mb-3 text-center">\
                        <a onclick="lister(\'Action\')" href="#">\
                            <img src="images/action.jpg" alt="" class="card-img-top">\
                        </a>\
                        <div class="card-body">\
                            <h5 class="card-title text-titre" >Action</h5>\
                        </div>\
                    </div>\
                    <div class="card img_accueil mx-2 mb-3 text-center">\
                        <a onclick="lister(\'Drame\')" href="#">\
                            <img src="images/drame.jpg" alt="" class="card-img-top">\
                        </a>\
                        <div class="card-body">\
                            <h5 class="card-title text-titre">Drame</h5>\
                        </div>\
                    </div>\
                    <div class="card img_accueil mx-2 mb-3 text-center">\
                        <a onclick="lister(\'Horreur\')" href="#">\
                            <img src="images/horreur.jpg" alt="" class="card-img-top">\
                        </a>\
                        <div class="card-body">\
                            <h5 class="card-title text-titre">Horreur</h5>\
                        </div>\
                    </div>\
                    <div class="card img_accueil mx-2 mb-3 text-center">\
                        <a onclick="lister(\'Science-fiction\')" href="#">\
                            <img src="images/sf.jpg" alt="" class="card-img-top">\
                        </a>\
                        <div class="card-body">\
                            <h5 class="card-title text-titre">Science-fiction</h5>\
                        </div>\
                    </div>\
                </div>';
    $('#contenu').html(rep);
}

/*$(document).ready(function() {

// Gets the video src from the data-src on each button

var $videoSrc;  
$('.video-btn').click(function() {
    $videoSrc = $(this).data( "src" );
});
console.log($videoSrc);  
  
// when the modal is opened autoplay it  
$('#preview').on('shown.bs.modal', function (e) {
    
// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
$("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
})

// stop playing the youtube video when I close the modal
$('#preview').on('hide.bs.modal', function (e) {
    // a poor man's stop video
    $("#video").attr('src',$videoSrc); 
}) 
    
// document ready  
});*/