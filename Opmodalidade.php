<?php
	$m = new MongoClient('localhost:27017');
	$db = $m->TC;
	$collection = $db->Modalidade;

    include '../class/classModalidade.php';
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
    if(isset($_POST['pri'])){
    	$moda=$_POST['Modalidade'];
    	header("location:../menu/Modalidade.php?Moda=".$moda);
    	// echo $moda;
    }
	function inserir(){	
		$m = new MongoClient('localhost:27017');
		$db = $m->TC;
		$collection = $db->Modalidade;

		$arquivo = fopen("../usuario.txt", "r");
		while(!feof($arquivo)){
			$linha=fgets($arquivo,4096);
		}
		$db2 = $m->Login;
		$collection2 = $db2->Login;

		$cursor2 = $collection2->find(array("_id" => new mongoId($linha)));

		$Modalidade = new DadosModalidade();
		foreach ($cursor2 as $entry) {
        $Modalidade->setNome($entry['Nome']);
		}
        $Modalidade->setNivel($_POST["Nivel"]);
        $Modalidade->setModalidade($_POST["Modalidade"]);


		$document = array(
			"Nome" =>  $Modalidade->getNome(),
			"Modalidade" =>  $Modalidade->getModalidade(),
			"Nivel" => $Modalidade->getNivel()
		);
		// var_dump($Campus);
		$collection->insert($document);
		header("location:../menu/Modalidade.php?");
		$m->closed();
	}
	function Excluir(){
		$m = new MongoClient('localhost:27017');
		$db = $m->TC;
		$collection = $db->Modalidade;
		$Id = '';
		$cursor2 = '';
		$Modalidade = new DadosModalidade();
		$Modalidade->setId($_GET["Id"]);
		$cursor2 = $collection->findOne(array("_id" => new MongoId($Modalidade->getId())));
		
		$collection->remove($cursor2);
		header("location:../menu/listModalidade.php?");
		$m->closed();
	}
	function alterar(){
		$m = new MongoClient('localhost:27017');
		$db = $m->TC;
		$collection = $db->Modalidade;
		$arquivo = fopen("../usuario.txt", "r");
		while(!feof($arquivo)){
			$linha=fgets($arquivo,4096);
		}
		$db2 = $m->Login;
		$collection2 = $db2->Login;

		$cursor2 = $collection2->find(array("_id" => new mongoId($linha)));

		$Modalidade = new DadosModalidade();
		foreach ($cursor2 as $entry) {
        $Modalidade->setNome($entry['Nome']);
		}
        $Modalidade->setNivel($_POST["Nivel"]);
        $Modalidade->setModalidade($_POST["Modalidade"]);
        $Modalidade->setId($_POST["Id"]);


		$document = array(
			"Nome" =>  $Modalidade->getNome(),
			"Modalidade" =>  $Modalidade->getModalidade(),
			"Nivel" => $Modalidade->getNivel()
		);

		$id=array(
			"_id" => new MongoId($Modalidade->getId())
		);

		$collection->update($id,$document);
		header("location:../menu/listModalidade.php?");
		$m->closed();
	}

?>
