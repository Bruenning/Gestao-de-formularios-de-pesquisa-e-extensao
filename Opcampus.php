<?php
	$m = new MongoClient('localhost:27017');
	$db = $m->TC;
	$collection = $db->Campus;

    include '../class/classCampus.php';
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
		$m = new MongoClient('localhost:27017');
		$db = $m->TC;
		$collection = $db->Campus;

		$Campus = new DadosCampus();
        $Campus->setCidade($_POST["Cidade"]);
        $Campus->setCampus($_POST["Campus"]);
        $Campus->setEstado($_POST["Estado"]);
        $Campus->setPais($_POST["Pais"]);
        $Campus->setSigla($_POST["Sigla"]);


		$document = array(
			"Campus" =>  $Campus->getCampus(),
			"Cidade" => $Campus->getCidade(),
			"Estado" =>  $Campus->getEstado(),
			"Pais" => $Campus->getPais(),
			"Sigla" =>$Campus->getSigla()
		);
		// var_dump($Campus);
		$collection->insert($document);
		header("location:../menu/Campus.php?");
		$m->closed();
	}
	function Excluir(){
		$m = new MongoClient('localhost:27017');
		$db = $m->TC;
		$collection = $db->Campus;
		$Id = '';
		$cursor2 = '';
		$Campus = new DadosCampus();
		$Campus->setId($_GET["Id"]);
		$cursor2 = $collection->findOne(array("_id" => new MongoId($Campus->getId())));
		
		$collection->remove($cursor2);
		header("location:../menu/listCampus.php?");
		$m->closed();
	}
	function alterar(){
		$m = new MongoClient('localhost:27017');
		$db = $m->TC;
		$collection = $db->Campus;
		$Campus = new DadosCampus();
        $Campus->setCidade($_POST["Cidade"]);
        $Campus->setCampus($_POST["Campus"]);
        $Campus->setEstado($_POST["Estado"]);
        $Campus->setPais($_POST["Pais"]);
        $Campus->setSigla($_POST["Sigla"]);
        $Campus->setId($_POST["Id"]);


		$document = array(
			"Campus" =>  $Campus->getCampus(),
			"Cidade" => $Campus->getCidade(),
			"Estado" =>  $Campus->getEstado(),
			"Pais" => $Campus->getPais(),
			"Sigla" =>$Campus->getSigla()
		);

		$id=array(
			"_id" => new MongoId($Campus->getId())
		);

		$collection->update($id,$document);
		header("location:../menu/listCampus.php?");
		$m->closed();
	}

?>
