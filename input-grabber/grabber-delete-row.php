<?php

	// Подключение Класса Link
  require_once('grabber-class-Link.php');


	Link::connect('kresloka.mysql.ukraine.com.ua', 'kresloka_il1', '9gu64q3b', 'kresloka_il1');
	
	$query = 	"SELECT * FROM grabber".
						" WHERE id = \"".$_POST['id']."\";";
	$query2 = "DELETE FROM grabber WHERE id = \"".$_POST['id']."\"";

	$answer = '';

	if ( Link::select($query) ) {
		if( Link::query($query2) ) {
			$answer = ["status" => true, "msg" => "Delete complete successfully!"];
		} else {		
			$answer = ["status" => false, "msg" => "ERROR! Delete incomplete!"];
		}
	}

	$answer = json_encode($answer);

	echo($answer);

?>