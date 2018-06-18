<?php
// fichier contenant les requetes suite au formulaire en ajax - permet d'inserer les données de ce formulaire où l'on veut en base

//cnx base
$link = mysqli_connect("localhost","root","", "db_boiteaoutils");


// récupération ID matrice selectionnée
$query_get_technos = "SELECT DISTINCT IDTechnologie, libelleTechno, brancheFinale, descLibelle, URL_image, URL_doc
		  FROM technologie 
		  WHERE idTechnologie IN 
		  (SELECT IDTechnoFils FROM matricetechnos WHERE IDTechnoPere = " . $_POST['id_techno'] . ")";

$res_technos = mysqli_query($link, $query_get_technos);


while($row = mysqli_fetch_assoc($res_technos)){
			echo "<div class='col-sm-2 zoom tuile' id='" . $row['IDTechnologie'] . "' style='background-color: #F7CA18;' onclick='get_technos(" . $row['IDTechnologie'] . ");'>";
				echo $row['libelleTechno']; 
			echo "</div>";
}

?>