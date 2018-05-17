<?php
	$str = $_POST['str'];
	$mass = explode(";", $str);
	$unic = array();
	$dost = array();
	
	//парсинг строки по "пробебел"
	//выявление уникальных символов
	foreach($mass as $key => $value){
		$mass[$key] = explode(",", $value);
		for($i = 0; $i < 2; $i++){
			$in = true;
			foreach($unic as $k => $v){
				if($mass[$key][$i] == $unic[$k]) {
					$in = false;
				}
			};
			if($in){
				array_push($unic, $mass[$key][$i]);
			}
		}
	}
	//обьявление двумерного массива
	foreach($unic as $k => $v){
		$dost[$v] = array();
	}
	//присвоение всем элементам значение 0
	foreach($dost as $key => $value) {
		foreach($unic as $k => $v) {
			$dost[$key][$v] = 0;
		}
	}
	
	
	//перенос из пары элементов в матрицу
	foreach($mass as $key => $value){
		$dost[$mass[$key][0]][$mass[$key][1]] = 1;
	}
	
	
	//нахождения достижимости
	do{
		$changed = false;
		foreach($dost as $i => $value1){
			foreach($dost[$i] as $ii => $value2){
				if($dost[$i][$ii] == 1) {
					foreach($dost[$ii] as $iii => $value3){
						if($dost[$ii][$iii] == 1) {
							if($dost[$i][$iii] == 0) {
								$changed = true;
								$dost[$i][$iii] = 1;
							}
						}
					}
				}
			}
		}
	} while($changed);
	
	
	
	//обьединение всех элементов в таблицу
	$out_str = "<table><tr><th>&nbsp;</th>";
	foreach($dost as $i => $value1){
		$out_str = $out_str."<th>".$i."</th>";
	}
	$out_str = $out_str."</tr>";
	foreach($dost as $i => $value1){
		$out_str = $out_str."<tr><th>".$i."</th>";
		foreach($dost[$i] as $ii => $value2){
			$out_str = $out_str."<th>".$value2."</th>";
		}
		$out_str = $out_str."</tr>";
	}
	
	$out_str = $out_str."</table>";
	// отправка результата
	header('Content-type: application/json');
	echo json_encode($out_str);
?>