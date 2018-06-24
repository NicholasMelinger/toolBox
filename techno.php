<?php
	// fichier contenant les requetes suite au formulaire en ajax - permet d'inserer les données de ce formulaire où l'on veut en base

	//cnx base

	if(isset($_GET['id_techno'])){
		$link = mysqli_connect("localhost","root","", "db_boiteaoutils");


		// récupération ID matrice selectionnée
		$query_get_technos = "SELECT DISTINCT IDTechnologie, libelleTechno, brancheFinale, descLibelle, URL_image, URL_doc
				  FROM technologie 
				  WHERE idTechnologie = " . $_GET['id_techno'];

		//echo $query_get_technos;
		$res = mysqli_query($link, $query_get_technos);
		$techno = mysqli_fetch_assoc($res);


		//var_dump($techno);
	}

	



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Dev'ToolBox</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/myCss.css">
	<link rel="stylesheet" href="assets/css/designTuile.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">

	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />


	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>


<body style="padding:20px 20px">


	
	<div class="container" > <!-- /container -->
		<p>
			<!-- Ligne 1 : Titre techno -->
			<div class="row">
			  <div class="col-xs-4">
			  	<img src=<?php echo "'" . $techno["URL_image"] . "'"; ?> style="heigth:100px; width:100px;">
			  </div>
			  <div class="col-xs-8">
			  	</br>
			  	<h1><?php echo $techno["libelleTechno"]; ?></h1>
			  </div>
			</div>
		</p>
		</br>
		<p>
			<!-- Ligne 2 : Description techno -->
			<div class="row" style="text-align:justify; text-justify:newspaper">
				<p>
					Metuentes igitur idem latrones Lycaoniam magna parte campestrem cum se inpares nostris fore congressione stataria documentis frequentibus scirent,
					tramitibus deviis petivere Pamphyliam diu quidem intactam sed timore populationum et caedium, milite per omnia diffuso propinqua, magnis undique 
					praesidiis conmunitam.
				</p>
				<p>
					Quid enim tam absurdum quam delectari multis inanimis rebus, ut honore, ut gloria, ut aedificio, ut vestitu cultuque corporis, animante virtute praedito, 
					eo qui vel amare vel, ut ita dicam, redamare possit, non admodum delectari? Nihil est enim remuneratione benevolentiae, nihil vicissitudine studiorum officiorumque
					iucundius.
				</p>
				
				<!-- 
				Bootstrap est une collection d'outils utile à la création du design (graphisme, animation et interactions avec la page dans le navigateur ... etc. ...)
				 de sites et d'applications web.
				</br>
				C'est un ensemble qui contient des codes HTML et CSS, des formulaires, boutons, outils de navigation et autres éléments interactifs, ainsi que des extensions JavaScript en option.
				</br>
				C'est l'un des projets les plus populaires sur la plate-forme de gestion de développement GitHub.
				-->
			</div>
		</p>
		</br></br>
		<p>
			<!-- Ligne 3 : Liens techno -->
			<div class="row" style="text-align:center" >
			  <a href=<?php echo "'" . $techno["URL_doc"] . "'" ?> class="btn btn-action btn-lg" role="button" target="_blank">Lien vers la documentation</a></p>
			</div>
		</p>
	</div>	<!-- /container -->

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
	<script src="assets/js/tuile.js"></script>
	<script src="assets/js/myJs.js"></script>
	<!-- Google Maps -->
	<script src="https://maps.googleapis.com/maps/api/js?key=&amp;sensor=false&amp;extension=.js"></script> 
	<script src="assets/js/google-map.js"></script>

	<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>	

</body>
</html>