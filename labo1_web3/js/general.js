function valider()
{	
	var titre=document.getElementById('titre').value;
	var res=document.getElementById('res').value;
    var res=document.getElementById('categ').value;
    var res=document.getElementById('duree').value;
    var res=document.getElementById('prix').value;
	if(titre!="" && res!="" && categ!="catégorie" && duree!="0" && prix!="0")
    {
		return true;
	}
    else
    {
		alert("Tout les champs doivent être remplis");
		return false;
	}
}

function lister()
{
	document.getElementById('formLister').submit();
}

