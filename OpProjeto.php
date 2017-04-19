<?php
	$m = new MongoClient('localhost:27017');
	$db = $m->TC;
	$collection = $db->Projeto;
    include '../class/classProjeto.php';
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
		$collection = $db->Projeto;
		
		$Projeto = new DadosProjeto();
        $Projeto->setProjeto($_POST["Projeto"]);
        $Projeto->setCampus($_POST["Campus"]);
        $Projeto->setModalidade($_POST["Modalidade"]);
        $Projeto->setresumo($_POST["resumo"]);
		$Projeto->setNomeAluno($_POST["NomeAluno"]);

		$document = array( 
			"Projeto" => $Projeto->getProjeto(),
			"Campus" => $Projeto->getCampus(),
			"Modalidade" =>$Projeto->getModalidade(),
			"resumo" =>$Projeto->getresumo(),
			"NomeAluno" =>$Projeto->getNomeAluno()
		);
		// var_dump($document);
		$collection->insert($document);
		header("location:../menu/Projeto.php?");
		$m->close();
	}
	function Excluir(){
		$m = new MongoClient('localhost:27017');
		$db = $m->TC;
		$collection = $db->Projeto;

		$Id = '';
		$cursor2 = '';
		$Projeto = new DadosProjeto();
		$Projeto->setId($_GET["Id"]);
		$cursor2 = $collection->findOne(array("_id" => new MongoId($Projeto->getId())));
		
		$collection->remove($cursor2);
		header("location:../menu/listProjeto.php?");
		$m->close();
	}
	function alterar(){
		$m = new MongoClient('localhost:27017');
		$db = $m->TC;
		$collection = $db->Projeto;

		$Projeto = new DadosProjeto();
        $Projeto->setProjeto($_POST["Projeto"]);
        $Projeto->setCampus($_POST["Campus"]);
        $Projeto->setModalidade($_POST["Modalidade"]);
        $Projeto->setModalidade($_POST["resumo"]);
		$Projeto->setNomeAluno($_POST["NomeAluno"]);
		$Projeto->setId($_POST["Id"]);

		$document = array( 
			"Projeto" => $Projeto->getProjeto(),
			"Campus" => $Projeto->getCampus(),
			"Modalidade" =>$Projeto->getModalidade(),
			"resumo" =>$Projeto->getresumo(),
			"NomeAluno" =>$Projeto->getNomeAluno()
		);
		$id=array(
			"_id" => new MongoId($Projeto->getId())
		);

		$collection->update($Id, $document);
		header("location:../menu/listProjeto.php?");
		$m->close();
	}

?>
