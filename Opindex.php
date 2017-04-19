<?php
	$m = new Mongo('localhost:27017');
	$db = $m->Login;
	$collection = $db->Login;
    require_once 'class/classLogin.php';
	$acao = '';
    if (isset($_GET["acao"]))
        $acao = $_GET["acao"];
    if ($acao == "Excluir"){
        Excluir();
    }else{
        if (isset($_POST["acao"])){
            $acao = $_POST["acao"];
            if ($acao == "salvar"){
                $codigo = 0;
                if (isset($_POST["codigo"])){
                    $codigo = $_POST["codigo"];
                    if ($codigo == 0)
                    inserir();
                    else
                    alterar();
                }
            }
        }
    }
	function inserir(){
		$m = new Mongo('localhost:27017');
		$db = $m->Login;
		$collection = $db->Login;
		// $password=$_POST["Pass"];
		// echo $password;
		$Login = new DadosLogin();
        $Login->setNome($_POST["Nome"]);
        $Login->setCPF($_POST["CPF"]);
        $Login->setpass($_POST["Pass"]);
        $Login->setemail($_POST["email"]);
        $Login->setCurso($_POST["Curso"]);

        // echo $Login->getpassword();

		$document = array(
			"Nome" =>  $Login->getNome(),
			"CPF" => $Login->getCPF(),
			"password" =>  $Login->getpass(),
			"email" =>  $Login->getemail(),
			"Curso" => $Login->getCurso()
		);
		var_dump($document);
		$collection->insert($document);
		header("location:index.php?");
		$m->close();
	}
	function Excluir(){

		$Id = '';
		$cursor2 = '';
		$Login = new DadosLogin();
		$Login->setId($_GET["Id"]);
		$cursor2 = $collection->findOne(array("_id" => new MongoId($Login->getId())));
		
		$collection->remove($cursor2);
		header("location:menu/meuPerfil.php?");
		$m->close();
	}
	function alterar(){

		$Login = new DadosLogin();
        $Login->setNome($_POST["Nome"]);
        $Login->setCPF($_POST["CPF"]);
        $Login->setpassword($_POST["password"]);
        $Login->setCurso($_POST["Curso"]);
        $Login->setId($_POST["Id"]);


		$document = array(
			"Nome" =>  $Login->getNome(),
			"CPF" => $Login->getCPF(),
			"password" =>  $Login->getpassword(),
			"Curso" => $Login->getCurso()
		);

		$id=array(
			"_id" => new MongoId($Login->getId())
		);

		$collection->update($id,$document);
		header("location:menu/meuPerfil.php?");
		$m->close();
	}

?>