<?php

	/*if(isset($_POST['id_techno'])){
		$link = mysqli_connect("localhost","root","", "db_boiteaoutils");

		$continue = true;
		$id_techno = $_POST['id_techno'];

		$query = "SELECT libelleTechno FROM technologie WHERE idTechnologie = " . $id_techno;
		$res= mysqli_query($link, $query);
		$libelle_techno_fils = mysqli_fetch_assoc($res)['libelleTechno'];


		$query = "SELECT IDTechnoPere FROM matricetechnos WHERE IDTechnoFils = " . $id_techno;
		$res= mysqli_query($link, $query);
		$id_techno_pere = mysqli_fetch_assoc($res)['IDTechnoPere'];

		if($id_techno_pere != '0'){
			$query =  "SELECT DISTINCT IDTechnologie, libelleTechno, brancheFinale, descLibelle, URL_image, URL_doc
			  			FROM technologie 
			  			WHERE idTechnologie = " .$id_techno_pere;

			//echo $query . "</br>";
			$res= mysqli_query($link, $query);
			$techno_pere = mysqli_fetch_assoc($res);

			echo "<td><div class='col-sm-2 zoom tuile-arbo' id='" . $techno_pere['IDTechnologie'] . "' style='background-color: #F7CA18;' onclick='get_technos(" . $techno_pere['IDTechnologie'] . ");set_arbo(" . $techno_pere['IDTechnologie'] . ");'>";
			echo 	$libelle_techno_fils; 
			echo "</div></td>";
			//echo $techno['libelleTechno'];
		}
		else{

			echo "<td><div class='col-sm-2 zoom tuile-arbo' style='background-color: #F7CA18;'>";
			echo "<a href='http://localhost/Boiteaoutils/ToolBoxV2/trouver_outil.html'>". $libelle_techno_fils ."</a>";
			echo "</div></td>";
			//echo "continue = false" . "</br>";

			$continue = false;
		}
	}*/



	//Ancienne version 

	/*$query = "SELECT libelleTechno FROM technologie WHERE idTechnologie = " . $id_techno;
	$res= mysqli_query($link, $query);
	$libelle_techno_arbo = mysqli_fetch_assoc($res)['IDTechnoPere'];*/

	$link = mysqli_connect("localhost","root","", "db_boiteaoutils");

	$continue = true;
	$id_techno = $_POST['id_techno'];
	$i = 0;
	$tableau_html = array();
	$colors =  array('#1C1C1C','#0B3B2E','#3B0B0B','#0A0A2A','#61380B','#0B3861');


	echo "<table><tr>";
	while($continue){
		$html = "";

		$id_techno_save = $id_techno;
		$query = "SELECT IDTechnoPere FROM matricetechnos WHERE IDTechnoFils = " . $id_techno;
		//echo $query . "</br>";
		$res= mysqli_query($link, $query);

		$id_techno = mysqli_fetch_assoc($res)['IDTechnoPere'];

		//echo "techno pere : " . $id_techno . "</br>";;
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
			 //echo $query . "</br>";

			$res= mysqli_query($link, $query);

			$techno_fils = mysqli_fetch_assoc($res);

			$html = $html .  "<td><div class='col-sm-2 zoom tuile-arbo' id='" . $techno_pere['IDTechnologie'] . "' style='background-color: " . $colors[rand(0, 5)] . ";' onclick='get_technos(" . $techno_pere['IDTechnologie'] . ");set_arbo(" . $techno_pere['IDTechnologie'] . ");'>";
			$html = $html .  	$techno_fils['libelleTechno']; 
			$html = $html .  "</div></td>";

			$tableau_html[$i]=$html;
			//echo $techno['libelleTechno'];
		}
		else{
			$query =  "SELECT DISTINCT IDTechnologie, libelleTechno, brancheFinale, descLibelle, URL_image, URL_doc
  			FROM technologie 
  			WHERE idTechnologie = " . $id_techno_save;

  			$res= mysqli_query($link, $query);

			$techno = mysqli_fetch_assoc($res);

			$html = $html . "<td><a href='trouver_outil.html' style='color:white;font-weight:bold;'><div class='col-sm-2 zoom tuile-arbo' style='background-color: " . $colors[rand(0, 5)] . ";'>";
			$html = $html . $techno['libelleTechno'];
			$html = $html . "</div></a></td>";

			$tableau_html[$i]=$html;

			$continue = false;
		}
		$i++;
	}

	$j = count($tableau_html)-1; 
	//echo "J : " . $j;
	//var_dump($tableau_html);
	for($j; $j>=0; $j--){
		echo $tableau_html[$j];
	}

	echo "</tr></table>";

?>
