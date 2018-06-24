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

	//echo $query_get_technos;
	echo "<table><tr>";
	while($row = mysqli_fetch_assoc($res_technos)){


				//TRACES
				/*echo $row['libelleTechno'] . " : " . $row['brancheFinale']  ; 
				echo "</br>";*/


				if($row['brancheFinale'] == "1") { // Branche finale
					echo "<td><a data-fancybox data-type='iframe' data-src='techno.php?id_techno=" . $row['IDTechnologie'] . "' href='javascript:;'>";
						echo "<img src='" . $row['URL_image'] . "' class='col-sm-2 zoom tuile' id='" . $row['IDTechnologie'] . "'  >";
						/*echo "<div class='col-sm-2 zoom tuile' id='" . $row['IDTechnologie'] . "' style='background-image: url('" . $row['URL_image'] . "');'>";
							echo $row['libelleTechno'] . " : " . $row['brancheFinale']  ; 
						echo "</div>";*/
					echo "</a></td>";
				}
				else{
					echo "<td><div class='col-sm-2 zoom tuile' id='" . $row['IDTechnologie'] . "' style='background-color: #F7CA18;' onclick='get_technos(" . $row['IDTechnologie'] . ");set_arbo(" . $row['IDTechnologie'] . ");'>";
						echo $row['libelleTechno'] . " : " . $row['brancheFinale']  ; 
					echo "</div></td>";
				}
	}
	echo "</td></table>";
?>
