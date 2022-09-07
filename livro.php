<?php
header("Acess-Control-Allow-Origin: *");
include('biblioteca.php');

$cd = isset($_GET['cd']) ? $_GET['livros'] : 0;

$todos = ListarLivros($cd);

$a = array();
while($p = $todos->fetch_object()){
	$a[] = $p;
}

$a = json_encode($a);
echo $a;

?>