<?php
	// Подключение Класса Link
	require_once('grabber-class-Link.php');
	
	Link::connect('kresloka.mysql.ukraine.com.ua', 'kresloka_il1', '9gu64q3b', 'kresloka_il1');

	$querySelect = 	"SELECT id, timestamp, email, ".
									"first_name, last_name, birth_country, ".
									"country_resid, prefix_phone, phone, ".
									"prefix_mobil, mobile ".
									"FROM grabber ".
									"ORDER BY `timestamp` DESC;";

	$data = Link::select($querySelect);
	?>

	<h1>Grabber pages</h1>
	<div class='grabber'>
		<?= Link::render($data); ?>
	</div>