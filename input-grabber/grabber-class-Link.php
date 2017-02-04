<?php
	/**
	* Класс для работы с БД MySQL
	*/
	class Link
	{
		public static $mysqli;

		public static function connect($server, $login, $pass, $dbname) {
			self::$mysqli = new mysqli($server, $login, $pass, $dbname);
		
			if (self::$mysqli->connect_error) {
			  die('Connect Error (' . self::$mysqli->connect_errno . ') ' . self::$mysqli->connect_error);
			}
		}

		public static function select($query) {
			if ($result = self::$mysqli->query($query)) {
				
				$array = [];

		    /* извлечение ассоциативного массива */
		    while ($row = $result->fetch_assoc()) {
		      array_push($array, $row); 
		    }

		    /* удаление выборки */
		    $result->free();
		    
		    return $array;
			
			} else {
				return false;
			}
		}

		public static function query($query) {
			return self::$mysqli->query($query);
		}

		public static function render($data) {
			$html = "<table>
								<tr>
									<th>#</th>
									<th>Дата</th>
									<th>Email</th>
									<th>Имя</th>
									<th>Фамилия</th>
									<th>Страна<br>происхождения</th>
									<th>Страна<br>регистрации</th>
									<th>Код<br>страны</th>
									<th>Номер<br>телефона</th>
									<th>Код2</th>
									<th>Номер2</th>
								</tr>";

			$i = 1;

			foreach ($data as $row) {
				$html .= "<tr data-id=\"".$row["id"]."\">";
				$html .= "<td>$i<br>".
							"<button class='delete-row' title='Удалить'><img src='".plugins_url('input-grabber/img/no-icon.png')."' alt='Удалить'></button>".
							"</td>";
				
				foreach ($row as $key => $value) {
					if($key !== 'id') {
						$html .= "<td>";
						$html .= $value;
						$html .= "</td>";
					}
				}
				
				$html .= "</tr>";
				$i++;
			}
				
			$html .= "</table>";
			$html .= "<div class='summary'>Всего: <span>".count($data)."</span> записей</div>";

			return $html;
		}

	}

?>