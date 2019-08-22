//vue films

function listerF(listFilms, categorie)
{
    $(document).ready(function() {
    liste(listFilms, categorie);
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
    });
}

function liste(listFilms, categorie)
{
    $('#contenu').html("");
    taille=listFilms.length;
    var rep = "";
    for(var i=0; i<taille; i++)
    {
        if (listFilms[i].categorie === categorie || categorie == null)
        {
            rep+='<div class="card mx-2 mb-3 text-center">\
                    <img src="pochettes/'+listFilms[i].image+'" alt="'+listFilms[i].titre+'" class="card-img-top img_location video-btn"\
                    data-toggle="modal" data-src="https://www.youtube.com/embed/'+listFilms[i].trailer+'"\
                    data-target="#preview">\
                    <div class="card-body">\
                        <h5 class="card-title text-titre">'+listFilms[i].titre+'</h5>\
                        <p class="card-text text-info">'+listFilms[i].realisateur+'</p>\
                        <p class="card-text text-info">'+listFilms[i].categorie+'</p>\
                        <p class="card-text text-info">'+listFilms[i].prix+' $</p>\
                    </div>\
              </div>';            
        }        
    }    
	/*var taille;
	var rep="<div class='table-users' style='overflow: scroll; height: 500px;'>";
	rep+="<div class='header'>Liste des films<span style='float:right;padding-right:10px;cursor:pointer;' onClick=\"$('#contenu').hide();\">X</span></div>";
	rep+="<table cellspacing='0'>";
	rep+="<tr><th>NUMERO</th><th>TITRE</th><th>DUREE</th><th>REALISATEUR</th><th>POCHETTE</th></tr>";
	taille=listFilms.length;
	for(var i=0; i<taille; i++){
		rep+="<tr><td>"+listFilms[i].idf+"</td><td>"+listFilms[i].titre+"</td><td>"+listFilms[i].duree+"</td><td>"+listFilms[i].res+"</td><td><img src='pochettes/"+listFilms[i].pochette+"' width=80 height=80></td></tr>";		 
	}
	rep+="</table>";
	rep+="</div>";*/
	$('#contenu').html(rep);
}

/*function afficherFiche(reponse){
  var uneFiche;
  if(reponse.OK){
	uneFiche=reponse.fiche;
	$('#formFicheF h3:first-child').html("Fiche du film numero "+uneFiche.idf);
	$('#idf').val(uneFiche.idf);
	$('#titreF').val(uneFiche.titre);
	$('#dureeF').val(uneFiche.duree);
	$('#resF').val(uneFiche.res);
	$('#divFormFiche').show();
	document.getElementById('divFormFiche').style.display='block';
  }else{
	$('#messages').html("Film "+$('#numF').val()+" introuvable");
	setTimeout(function(){ $('#messages').html(""); }, 5000);
  }

}*/

var filmsVue=function(reponse,categorie){
	var action=reponse.action; 
	switch(action){
		case "enregistrer" :
		case "enlever" :
		case "modifier" :
			/*$('#messages').html(reponse.msg);
			setTimeout(function(){ $('#messages').html(""); }, 5000);
		break;*/
		case "lister" :            
			listerF(reponse.listeFilms,categorie);
		break;
		case "fiche" :
			//afficherFiche(reponse);
		break;		
	}
}

