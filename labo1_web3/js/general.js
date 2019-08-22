function load()
{    
    if (localStorage.getItem('panier') !== null) 
    {        
        listePanier = JSON.parse(localStorage.getItem('panier'));
        nbrItemPanier = JSON.parse(localStorage.getItem('nombre'));
        prixPanierTotal = JSON.parse(localStorage.getItem('prix'));
    }    
    totalPanier();
    affichPanier();
}

function chargerPanier(stringPanier)
{
    if (stringPanier != null)
    {
        var panier = JSON.parse(stringPanier);
        var nombre = panier.length;
        var prix = 0;
        for (var i = 0 ; i < nombre ; i++)
        {
             prix += panier[i].prix * panier[i].quantite;   
        }
        localStorage.setItem('panier', stringPanier);
        localStorage.setItem('nombre', nombre);
        localStorage.setItem('prix', prix);
        totalPanier();
        affichPanier();
    }    
}

function sauver()
{
	var panier = document.getElementById('sauverPanier'); 
    if ('panier' in localStorage && localStorage.getItem('panier') != "[]")    
	{           
        panier.value = localStorage.getItem('panier'); 
    }
	else
	{
		panier.value = "";
	}
    document.getElementById('form_sauver').submit();    
}

function commander()
{    
        var panier = document.getElementById('panier')
        panier.value = localStorage.getItem('panier');        
        document.getElementById('form_commande').submit();      
        listePanier = [];
		nbrItemPanier = 0;
		prixPanierTotal = 0;
		localStorage.removeItem('panier');
		localStorage.removeItem('nombre');
		localStorage.removeItem('prix');
}

function deconnexion()
{
	document.getElementById('form_logout').submit();
}

function lister(id)
{
    if(id == null)
    {
        document.getElementById('form_listeFilm').submit();
    }
    else if (id == 1)
    {        
        document.getElementById('form_listeFilmAction').submit();
    }
    else if (id == 2)
    {        
        document.getElementById('form_listeFilmDrame').submit();
    }
    else if (id == 3)
    {        
        document.getElementById('form_listeFilmHorreur').submit();
    }
    else if (id == 4)
    {        
        document.getElementById('form_listeFilmSF').submit();
    }
}

function getQuantite()
{
    return document.getElementById("quantite").value;
}

$(document).ready(function() {

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

window.onbeforeunload = closingCode;
function closingCode()
{
   deconnexion();
   return null;
}
