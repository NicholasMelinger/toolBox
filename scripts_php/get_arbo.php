<?php

	$link = mysqli_connect("localhost","root","", "db_boiteaoutils");

	$continue = true;
	$id_techno = $_POST['id_techno'];

	/*$query = "SELECT libelleTechno FROM technologie WHERE idTechnologie = " . $id_techno;
	$res= mysqli_query($link, $query);
	$libelle_techno_arbo = mysqli_fetch_assoc($res)['IDTechnoPere'];*/

	echo "<table><tr>";
	while($continue){
		$id_techno_save = $id_techno;
		$query = "SELECT IDTechnoPere FROM matricetechnos WHERE IDTechnoFils = " . $id_techno;
		//echo $query . "</br>";
		$res= mysqli_query($link, $query);

		$id_techno = mysqli_fetch_assoc($res)['IDTechnoPere'];

		echo "techno pere : " . $id_techno . "</br>";;
		if($id_techno != '0'){
			$query =  "SELECT DISTINCT IDTechnologie, libelleTechno, brancheFinale, descLibelle, URL_image, URL_doc
			  			FROM technologie 
			  			WHERE idTechnologie = " .$id_techno;

			//echo $query . "</br>";
			$res= mysqli_query($link, $query);

			$techno_pere = mysqli_fetch_assoc($res);

			$query = "SELECT DISTINCT IDTechnologie, libelleTechno, brancheFinale, descLibelle, URL_image, URL_doc
			  FROM technologie 
			  WHERE idTechnologie IN 
			  (SELECT IDTechnoFils FROM matricetechnos WHERE IDTechnoPere = " . $techno_pere['IDTechnologie'] . ")";
			 echo $query . "</br>";

			$res= mysqli_query($link, $query);

			$techno_fils = mysqli_fetch_assoc($res);

			echo "<td><div class='col-sm-2 zoom tuile' id='" . $techno_pere['IDTechnologie'] . "' style='background-color: #F7CA18;' onclick='get_technos(" . $techno_pere['IDTechnologie'] . ");set_arbo(" . $techno_pere['IDTechnologie'] . ");'>";
			echo 	$techno_fils['libelleTechno']; 
			echo "</div></td>";
			//echo $techno['libelleTechno'];
		}
		else{
			$query =  "SELECT DISTINCT IDTechnologie, libelleTechno, brancheFinale, descLibelle, URL_image, URL_doc
  			FROM technologie 
  			WHERE idTechnologie = " . $id_techno_save;

  			$res= mysqli_query($link, $query);

			$techno = mysqli_fetch_assoc($res);

			//echo "continue = false" . "</br>";
			echo "<a href='http://localhost/InterfaceWeb/ToolBox/toolBox/trouver_outil.html'>". $techno['libelleTechno'] ."</a>";
			$continue = false;
		}
	}
	echo "</tr></table>";

?>
