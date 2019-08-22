var listePanier = [],nbrItemPanier = 0,prixPanierTotal = 0;

function ajouter(image, titre, prix, id)
{        
    var sel = document.getElementById("quantite"+id+"");
    var quantite = parseInt(sel.options[sel.selectedIndex].value);
    var film={"image":image,"titre":titre,"quantite":quantite,"prix":prix,"id":id};
      
    var taille=listePanier.length;
    if (taille === 0)
        {            
            listePanier.push(film);            
        }
    else 
    {
        var j = 0;
        for (j=0;j<taille;j++)
        {
            var unFilm=listePanier[j];
            if(unFilm.id == id)
            {                
                 unFilm.quantite+=quantite;                
                 break;
            }            
        }
        if (j == taille)
            {                
                listePanier.push(film);                
            }
    }
	localStorage.setItem('panier', JSON.stringify(listePanier));
    localStorage.setItem('nombre', JSON.stringify(nbrItemPanier));
    localStorage.setItem('prix', JSON.stringify(prixPanierTotal));
	sauver();
    totalPanier();    
}

function supprimer(id)
{
    var taille=listePanier.length;
    for (var i=0;i<taille;i++)
    {
        var unFilm=listePanier[i];
        if(unFilm.id == id)
            {                
                listePanier.splice(i, 1);
                break;
            }        
    }    
    localStorage.setItem('panier', JSON.stringify(listePanier));
    localStorage.setItem('nombre', JSON.stringify(nbrItemPanier));
    localStorage.setItem('prix', JSON.stringify(prixPanierTotal));	
	sauver();
	totalPanier();
    affichPanier();    
}

function retirer(id)
{
    var taille=listePanier.length;
    for (var i=0;i<taille;i++)
    {
        var unFilm=listePanier[i];
        if(unFilm.id == id)
            {                
                listePanier[i].quantite--;
                break;
            }        
    }    
    localStorage.setItem('panier', JSON.stringify(listePanier));
    localStorage.setItem('nombre', JSON.stringify(nbrItemPanier));
    localStorage.setItem('prix', JSON.stringify(prixPanierTotal));
	sauver();
	totalPanier();
    affichPanier();
}

function affichPanier()
{    
    var image, titre, quantite = 0,prix = 0;
    $('#contenu').html("");
    var rep = "";	
	var taille=listePanier.length;
    var totalHT = 0;
	rep+="<h2>Liste des films dans votre panier</h2><br><br><div class=\"row custom-center\"><div class=\"col-sm-12 col-md-10 col-md-offset-1 custom-center\"><button type=\"button\" id=\"vider\" class=\"btn btn-danger marge-bas float-right\" onclick=\"vider()\">Vider le panier</button><table class=\"table table-hover table-striped\"><thead><tr><th>Pochette</th><th class=\"text-center\">Titre</th><th class=\"text-center\">Quantité</th><th class=\"text-center\">Prix</th><th> </th><th> </th><th> </th></tr></thead><tbody>";
	for (var i=0;i<taille;i++){
		var unFilm=listePanier[i];
		image=unFilm.image;
		titre=unFilm.titre;
        quantite=unFilm.quantite;
        prix=unFilm.prix;
        id=unFilm.id;
        		
        rep+="<tr><td class=\"col-sm-1 col-md-1\"><div class=\"media\"><img class=\"img_crud\" src=\'../pochettes/"+image+"\' alt=\"Film numéro "+id+"\" title=\"image de la boite du film "+titre+"\"></a></div></td><td class=\"col-sm-1 col-md-1 text-center\">"+titre+"</td><td class=\"col-sm-1 col-md-1 text-center\">"+quantite+"</td><td class=\"col-sm-1 col-md-1 text-center\">"+prix.toFixed(2)+"$</td>";
        if (unFilm.quantite == 1)
            {
                rep+="<td class=\"col-sm-1 col-md-1\"></td><td class=\"col-sm-1 col-md-1 text-center\"><button type=\"button\" class=\"btn btn-danger\" onclick=\"supprimer(\'"+id+"\')\">Supprimer</button></td>";                
            }
        else
            {
                rep+="<td class=\"col-sm-1 col-md-1 text-center\"><button type=\"button\" class=\"btn btn-warning\" onclick=\"retirer(\'"+id+"\')\">Enlever 1 film</button></td><td class=\"col-sm-1 col-md-1 text-center\"><button type=\"button\" class=\"btn btn-danger\" onclick=\"supprimer(\'"+id+"\')\">Supprimer</button></td>";                
            }
        rep+="<td class=\"col-sm-1 col-md-1\"></td></tr>";
        totalHT += (prix * quantite);
	}
    rep+="</tbody><tfoot><tr><td>   </td><td>   </td><td>   </td><td>   </td><td>   </td><td></td><td class=\"text-right\"><h3><strong>Sous-total:&nbsp;</strong>"+totalHT.toFixed(2)+"&nbsp;$</h3></td></tr>     <tr><td>   </td><td>   </td><td>   </td><td>   </td><td>   </td><td></td><td class=\"text-right\"><h3><strong>TVQ:&nbsp;</strong>"+(totalHT * 0.09975).toFixed(2)+"&nbsp;$</h3></td></tr>     <tr><td>   </td><td>   </td><td>   </td><td>   </td><td>   </td><td></td><td class=\"text-right\"><h3><strong>TPS:&nbsp;</strong>"+(totalHT * 0.05).toFixed(2)+"&nbsp;$</h3></td></tr>     <tr><td>   </td><td>   </td><td>   </td><td>   </td><td>   </td><td></td><td class=\"text-right\"><h3><strong>Total:&nbsp;</strong>"+(totalHT * 1.14975).toFixed(2)+"&nbsp;$</h3></td></tr></tfoot></table><button type=\"button\" id=\"commande\" class=\"btn btn-primary marge-bas float-right\" onclick=\"commander()\">Commander</button></div></div>";    
	$('#contenu').html(rep);
    if(i == 0)
    {
        document.getElementById('vider').style.visibility = 'hidden';
        document.getElementById('commande').style.visibility = 'hidden';
    }    
}

function totalPanier()
{
    nbrItemPanier = 0;
    prixPanierTotal = 0;
    var taille=listePanier.length;    
    for (var i=0;i<taille;i++)
    {
        nbrItemPanier+= listePanier[i].quantite;
        prixPanierTotal += listePanier[i].quantite * listePanier[i].prix;
    }
    var rep = "("+nbrItemPanier+") "+prixPanierTotal.toFixed(2)+" $";    
    $('#totalPanier').html(rep);
}

function vider()
{
    listePanier = [];
    nbrItemPanier = 0;
    prixPanierTotal = 0;
    localStorage.removeItem('panier');
    localStorage.removeItem('nombre');
    localStorage.removeItem('prix');
	sauver();
    totalPanier();
    affichPanier();
}






