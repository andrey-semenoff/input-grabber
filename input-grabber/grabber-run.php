<?php

	// Подключение Класса Link
  require_once('grabber-class-Link.php');

	Link::connect('kresloka.mysql.ukraine.com.ua', 'kresloka_il1', '9gu64q3b', 'kresloka_il1');

	$querySelect = 	"SELECT * FROM grabber".
						" WHERE uniqueID = \"".$_POST['uniqueID']."\";";
	
	$queryInsert = "INSERT INTO grabber ".
						"(id, uniqueID, username, email, email_2, first_name, ".
						"last_name, marit_status, birth_country, country_resid, ".
						"working, h_school, prefix_phone, phone, prefix_mobil, mobile) ".
						"VALUES ".
						"(NULL, ".
						"\"".$_POST['uniqueID']."\", ".
						"\"".$_POST['username']."\", ".
						"\"".$_POST['email']."\", ".
						"\"".$_POST['email_2']."\", ".
						"\"".$_POST['first_name']."\", ".
						"\"".$_POST['last_name']."\", ".
						"\"".$_POST['marit_status']."\", ".
						"\"".$_POST['birth_country']."\", ".
						"\"".$_POST['country_resid']."\", ".
						"\"".$_POST['working']."\", ".
						"\"".$_POST['h_school']."\", ".
						"\"".$_POST['prefix_phone']."\", ".
						"\"".$_POST['phone']."\", ".
						"\"".$_POST['prefix_mobil']."\", ".
						"\"".$_POST['mobile']."\"".
						");";

	$queryUpdate = "UPDATE grabber ".
						"SET ".
						"username = \"".$_POST['username']."\",".
						"email = \"".$_POST['email']."\", ".
						"email_2 = \"".$_POST['email_2']."\", ".
						"first_name = \"".$_POST['first_name']."\", ".
						"last_name = \"".$_POST['last_name']."\", ".
						"marit_status = \"".$_POST['marit_status']."\", ".
						"birth_country = \"".$_POST['birth_country']."\", ".
						"country_resid = \"".$_POST['country_resid']."\", ".
						"working = \"".$_POST['working']."\", ".
						"h_school = \"".$_POST['h_school']."\", ".
						"prefix_phone = \"".$_POST['prefix_phone']."\", ".
						"phone = \"".$_POST['phone']."\", ".
						"prefix_mobil = \"".$_POST['prefix_mobil']."\", ".
						"mobile = \"".$_POST['mobile']."\" ".
						"WHERE ".
						"uniqueID = \"".$_POST['uniqueID']."\";";

	$msg = [];

	if ( Link::select($querySelect) ) {
		if( Link::query($queryUpdate) ) {
			array_push($msg, ["msg" => "Update complete successfully!"]);
		}		
	} else {	
		if( Link::query($queryInsert) ) {
			array_push($msg, ["msg" => "Insert complete successfully!"]);
		}
	}

	$answer = array_merge($msg, Link::select($querySelect));

	$data = json_encode($answer);
	
	echo($data);

?>