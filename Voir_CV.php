<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="script.js"></script>
<div id='title' style="text-align:center;">
<h1 style="text-align:center;">Visualisation de CV</h1>
</div>
</head>

<body background="Background.jpg">
<div id='cssmenu'>
<ul>
   <li><a href='index.html'><span>Accueil</span></a></li>
   <li><a href='Faire_CV.php'><span>Créer un CV</span></a></li>
   <li><a href='Voir_CV.php'><span>Visualiser un CV</span></a></li>
</ul>
</div>
<form method="post">
</br>
<div id='metier' style="text-align:center;">
<?php
$pdo = new PDO("mysql:host=localhost;dbname=CV", "root", "");
$rslt = $pdo->prepare("Select DISTINCT nom FROM document");
$rslt->execute();
$data = $rslt->fetchAll();
?>
<select name="nom" id="nom">

<?php foreach ($data as $row): ?>
    <option><?=$row["nom"]?></option>
<?php endforeach ?>


</select>
<input type="submit" />
<?php
error_reporting(0);
$value = $_POST["nom"];
?>

<?php
$rslt->closeCursor();
?>
</ div>
<br /><br />
<div id='CompList' style="text-align:center;">

<h1>INFORMATION SUR LA PERSONNE</h1>

<?php
error_reporting(0);
$pdo = new PDO("mysql:host=localhost;dbname=CV", "root", "");
$params = array(':nom' => $value);
$rslt = $pdo->prepare("Select nom,prenom,age,information FROM document WHERE document.nom = :nom");
$rslt->execute($params);
$rslt->setFetchMode(PDO::FETCH_OBJ);

while( $ligne = $rslt->fetch() )
{		
		
		echo "Nom : ";
		echo $ligne->nom."<br />";
		echo "Prenom : ";
		echo $ligne->prenom."<br />";
		echo "Âge : ";
		echo $ligne->age."<br />";
		echo "<br />";
		echo $ligne->information."<br />";		
}
$rslt->closeCursor();
?>

<h1>EXPERIENCE</h1>

<?php
error_reporting(0);
$pdo = new PDO("mysql:host=localhost;dbname=CV", "root", "");
$params = array(':nom' => $value);
$rslt = $pdo->prepare("Select experience FROM document WHERE document.nom = :nom");
$rslt->execute($params);
$rslt->setFetchMode(PDO::FETCH_OBJ);

while( $ligne = $rslt->fetch() )
{		
		
		echo $ligne->experience."<br />";
				
}
$rslt->closeCursor();
?>

<h1>FORMATION</h1>

<?php
error_reporting(0);
$pdo = new PDO("mysql:host=localhost;dbname=CV", "root", "");
$params = array(':nom' => $value);
$rslt = $pdo->prepare("Select formation FROM document WHERE document.nom = :nom");
$rslt->execute($params);
$rslt->setFetchMode(PDO::FETCH_OBJ);

while( $ligne = $rslt->fetch() )
{		
		
		echo $ligne->formation."<br />";
				
}
$rslt->closeCursor();
?>

<h1>AUTRE</h1>

<?php
error_reporting(0);
$pdo = new PDO("mysql:host=localhost;dbname=CV", "root", "");
$params = array(':nom' => $value);
$rslt = $pdo->prepare("Select autre FROM document WHERE document.nom = :nom");
$rslt->execute($params);
$rslt->setFetchMode(PDO::FETCH_OBJ);

while( $ligne = $rslt->fetch() )
{		
		echo "<br />";
		echo $ligne->autre."<br />";
				
}
$rslt->closeCursor();
?>

</div>
</form>
</body>
</html>