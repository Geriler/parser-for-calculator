<?php


require 'validation.php';
require 'functions.php';


$post = $_POST;
$exp = $post['val'];

$_SESSION['val'] = $exp;
$exp = validation($exp);

if (!$exp == NULL) {
	//


	//echo $exp . "<br>";
	while (preg_match('#[(]([0-9\*\/\+\-.])+[)]#', $exp)) {
		$exp = brackets($exp);
		
	}


	$exp = division($exp);
	$exp = multiplication($exp);
	$exp = add_sub($exp);
	echo $exp. "<br>";
}






?>

<form action="index.php" method="post">
	
	<input type="text" name="val" value="<?php echo $_SESSION['val']; ?>">
	<input type="submit" name="ok">
</form>