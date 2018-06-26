<?php
	// fichier contenant les requetes suite au formulaire en ajax - permet d'inserer les données de ce formulaire où l'on veut en base

	//cnx base
	$link = mysqli_connect("localhost","root","", "db_boiteaoutils");



	// récupération ID matrice selectionnée
	$query_get_technos = "SELECT DISTINCT IDTechnologie, libelleTechno, brancheFinale, descLibelle, URL_image, URL_doc
			  FROM technologie 
			  WHERE idTechnologie IN 
			  (SELECT IDTechnoFils FROM matricetechnos WHERE IDTechnoPere = " . $_POST['id_techno'] . ")";
	$res_technos= mysqli_query($link, $query_get_technos);



	$colors =  array('#1C1C1C','#0B3B2E','#3B0B0B','#0A0A2A','#61380B','#0B3861');


	//echo $query_get_technos;
	echo "<table><tr>";
	while($row = mysqli_fetch_assoc($res_technos)){


				//TRACES
				/*echo $row['libelleTechno'] . " : " . $row['brancheFinale']  ; 
				echo "</br>";*/


				if($row['brancheFinale'] == "1") { // Branche finale
					echo "<td><a data-fancybox data-type='iframe' data-src='techno.php?id_techno=" . $row['IDTechnologie'] . "' href='javascript:;'><div class='col-sm-2 finale zoom tuile'>";
						echo "<img src='" . $row['URL_image'] . "'  id='" . $row['IDTechnologie'] . "'   >";
					echo "</div></a></td>";
				}
				else{
					echo "<td><div class='col-sm-2 zoom tuile' id='" . $row['IDTechnologie'] . "' style='background-color: " . $colors[rand(0, 5)] . ";' onclick='get_technos(" . $row['IDTechnologie'] . ");set_arbo(" . $row['IDTechnologie'] . ");'>";
						echo $row['libelleTechno'] ; 
					echo "</div></td>";
				}
	}
	echo "</td></table>";
?>
