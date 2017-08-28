<?php


	function validation($exp){

$exp = str_replace(',', '.', $exp);

$exp = trim($exp);
$exp = str_replace(" ", "", $exp);
$exp = htmlspecialchars($exp);
if (preg_match('#([0-9])+([.]([0-9])+)?[(]#', $exp)) {
	echo "something wrong [*]";
	$exp = NULL;
}
if (preg_match('#[)]([0-9])+([.]([0-9])+)?#', $exp)) {
	echo "something wrong [*]";
	$exp = NULL;
}

if (preg_match('#([A-Za-z\!\@\#\$\%\^\&\"\'\:\;])+#', $exp)) {
	echo "something wrong";
	$exp = NULL;
}

if (preg_match('#[(]([0-9\*\/\+\-.])+#', $exp)) {
	if (!preg_match('#([0-9\*\/\+\-.])+[)]#', $exp)) {
		echo "something wrong [()]";
		$exp = NULL;

	}
}
if (mb_substr_count($exp, '(') !== mb_substr_count($exp, ')')) {
	echo "something wrong [()]";
		$exp = NULL;
}
return $exp;

	}




?>