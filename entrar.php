<?php
	$m = new Mongo('localhost:27017');
	$db = $m->Login;
	$collection = $db->Login;

	$acao='';
	if (isset($_POST['acao'])) {
		$acao=$_POST['acao'];
	}
	if($acao == 'entrar'){
		$user3=false;
		$user='';
		$pass='';
		$user=$_POST['email'];
		$pass=$_POST['password'];
		// echo $user, $pass;
		$cursor = $collection->find(array('email' => $user, 'password' => $pass));
		// var_dump($cursor);
		foreach ($cursor as $entry) {
			$user3=true;
			$user2=$entry['email'];
			if($user2 == $user){
				$arquivo = fopen("usuario.txt", "w");
				$mostrar = $entry['_id'];
				$linha="";
				$linha = $mostrar;
				$escreve = fwrite($arquivo,strval($linha));
				header("location:menu/home.php");
			}
		}
		if($user3==false){
			header("location:index.php");
		}
	}
?>