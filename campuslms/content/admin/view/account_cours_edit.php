<!--<header>
	<h1>Administration</h1>
	<h2>Groupes de l'utilisateur</h2>
</header>-->

<form method="post" action="<?php echo implode('/',$_GET['qs']); ?>" class="openInMenuBar">
	<h1>Ajouter l'utilisteur à un cours</h1>
	<div class="clr"></div>

<?php
	$salt = uniqid();
	echo '<input type="hidden" name="salt" id="salt" value="'.$salt.'"/>';
?>

	<select name="cours" id="cours" class="specialField" data-specialType="selectHelper" data-placeholder='Pour ajouter un cours, sélectionnez-le ici.'>
<?php
	if (!($_GET['qs']['4'] > 0)){
		echo '<option value="0">Pour ajouter un cours, sélectionnez-le ici.</option>';
	}
	$mysqli = dbconnect();
	$req = "SELECT cours.nom AS cnom, cours_lecon.nom AS lnom, cours_lecon.id FROM cours, cours_lecon WHERE cours.type='group' AND cours_lecon.id_cours=cours.id ORDER BY cours.nom ASC, cours_lecon.nom ASC";

	$query = $mysqli->query($req);
	$i = 0;
	while($res = $query->fetch_array(MYSQLI_ASSOC)){
		if (!isset($data[$res['id']])){
			$i++;
			echo '<option value="'.createValidateKey($res['id'], $salt).'"'.(($data['id_groupe'] == $res['id'])?' selected="selected"':'').'>'.$res['cnom'].' / '.$res['lnom'].'</option>';
		}
	}
	$mysqli->close();

	if ($i == 0){
		echo '<option value="0" selected="selected">Cet utilisateur est déjà membre de l\'ensemble des cours</option>';
	}
?>
	</select>
<?php
/*	<input type="date" class="text specialField" placeholder="Date de fin (YYYY-MM-DD) - laissez vide si sans fin" name="datefin" id="datefin" value="<?php echo $data['datefin']; ?>" data-specialType="dateHelper">*/
?>
	<input type="submit" class="submit" value="Sauvegarder"/>
	<a class="cancel" href="#">Annuler</a>
</form>