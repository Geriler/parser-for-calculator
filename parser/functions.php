<?php


function brackets($exp){
	if (preg_match_all('#[(]([0-9\*\/\+\-.])+[)]#', $exp, $matches)) {
		

		foreach ($matches[0] as $data) {


			$change = str_replace('(', '', $data);
			$change = str_replace(')', '', $change);
			$change = division($change);
			$change = multiplication($change);
			$change = add_sub($change);

			$exp = str_replace($data, $change, $exp);
			//echo $exp ."<br>";
		}
		return $exp;
	}

}
function division($exp){

	if (preg_match_all('#([-])?([0-9])+([.]([0-9])+)?[/]([-])?([0-9])+([.]([0-9])+)?([/]([-])?([0-9])+([.]([0-9])+)?)*#', $exp, $matches)) {

		foreach ($matches[0] as $data) {
			// echo $data . "<br>";

			$div = explode('/', $data);
			$c_div = count($div);
			// var_dump($div);
			// echo "<hr>";

			$result = 0;
			for ($d=0; $d < $c_div; $d++) { 
				if (!$div[$d+1] === false) {
					$result = $div[$d] / $div[$d+1];
					$d += 1;
				}else{
					$result /=$div[$d];
				}
			}
			$exp = str_replace($data, $result, $exp);
			return $exp;

		}

	}else{
		return $exp;
	}
}
function multiplication($exp){
if (preg_match_all('#([-])?([0-9])+([.]([0-9])+)?[*]([-])?([0-9])+([.]([0-9])+)?([*]([-])?([0-9])+([.]([0-9])+)?)*#', $exp, $matches)) {
	

	foreach ($matches[0] as $data) {
		

		$mult = explode('*', $data);
		$c_mult = count($mult);

		$result = 1;
		for ($m=0; $m < $c_mult; $m++) { 
			$result *=$mult[$m];
		}

		$exp = str_replace($data, $result, $exp);
		

	}
	return $exp;

}else{
	return $exp;
}



}
function addition($exp){
	if (preg_match('#^([0-9])+([.]([0-9])+)?#', $exp)){
		$exp = '+' . $exp;
	}
	if (preg_match_all('#[+]([0-9])+([.]([0-9])+)?#', $exp, $matches)) {
		$result = 0;
		foreach ($matches[0] as $data) {
			$data = str_replace('+', '', $data);
			
			$result += $data;
		}
		return $result;
	}
}
function substraction($exp) {
	if (preg_match_all('#[-]([0-9])+([.]([0-9])+)?#', $exp, $matches)) {
		$result = 0;
		foreach ($matches[0] as $data) {
			$data = str_replace('-', '', $data);
			$result += $data;
		}
		
		return $result;
	}
}

function add_sub($exp){
	$add = addition($exp);
	$sub = substraction($exp);

	$res = $add - $sub;
	return $res;
}